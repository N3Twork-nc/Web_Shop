# Generate random resource group name


resource "azurerm_resource_group" "rg" {
  location = var.resource_group_location
  name     = "aks_rg"
}

resource "random_pet" "azurerm_kubernetes_cluster_name" {
  prefix = "cluster"
}

resource "random_pet" "azurerm_kubernetes_cluster_dns_prefix" {
  prefix = "dns"
}

resource "azurerm_storage_account" "storage" {
  name                     = "n3tworkstorage"
  resource_group_name      = azurerm_resource_group.rg.name
  location                 = azurerm_resource_group.rg.location
  account_tier              = "Standard"
  account_replication_type = "LRS"
}

# Tạo Blob Container
resource "azurerm_storage_container" "blob" {
  name                  = "aks"
  storage_account_name  = azurerm_storage_account.storage.name
  container_access_type = "private"
}

resource "azurerm_kubernetes_cluster" "k8s" {
  location            = azurerm_resource_group.rg.location
  name                = random_pet.azurerm_kubernetes_cluster_name.id
  resource_group_name = azurerm_resource_group.rg.name
  dns_prefix          = random_pet.azurerm_kubernetes_cluster_dns_prefix.id

  identity {
    type = "SystemAssigned"
  }

  default_node_pool {
    name       = "agentpool"
    vm_size    = "Standard_D2_v2"
    node_count = var.node_count
  }
  linux_profile {
    admin_username = var.username

    ssh_key {
      key_data = azapi_resource_action.ssh_public_key_gen.output.publicKey
    }
  }
  network_profile {
    network_plugin    = "kubenet"
    load_balancer_sku = "standard"
  }
}
# Gán quyền truy cập cho AKS vào Azure Blob Storage
resource "azurerm_role_assignment" "aks_blob_access" {
  scope                = azurerm_storage_account.storage.id
  role_definition_name = "Storage Blob Data Contributor"
  principal_id         = azurerm_kubernetes_cluster.k8s.identity[0].principal_id
}

resource "azurerm_container_registry" "acr" {
  name                = "N3TRegistry"
  resource_group_name = azurerm_resource_group.rg.name
  location            = azurerm_resource_group.rg.location
  sku                 = "Standard"
  admin_enabled       = false
}
# Manages the MySQL Flexible Server
resource "azurerm_mysql_flexible_server" "default" {
  location                     = azurerm_resource_group.rg.location
  name                         = "n3tworkdb"
  resource_group_name          = azurerm_resource_group.rg.name
  administrator_login          = "n3twork"
  administrator_password       = "n3twork@"
  backup_retention_days        = 7
  geo_redundant_backup_enabled = false
  sku_name                     = "B_Standard_B1ms"
  version                      = "8.0.21"
  storage {
    iops    = 360
    size_gb = 20
  }
  # provisioner "local-exec" {
  #   command = "mysql -h ${self.fqdn} -u ${self.administrator_login} -p${self.administrator_password} < db.sql"
  # }

}