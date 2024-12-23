# Generate random resource group name


resource "azurerm_resource_group" "rg" {
  location = var.resource_group_location
  name     = "aks_rg"
}

resource "azurerm_role_assignment" "example" {
  principal_id          = "24b215c2-b5ca-4272-a905-74a5acefe83a"  # Replace with the Object ID
  role_definition_name  = "Contributor"          # Or "Reader", "Owner"
  scope                 = azurerm_resource_group.rg.id
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


resource "azurerm_storage_share" "file_share" {
  name                 = "aks"
  storage_account_name = azurerm_storage_account.storage.name
  quota                = 10  # Dung lượng tối đa cho File Share, tính bằng GB (tùy chỉnh theo nhu cầu)
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
}

resource "azurerm_storage_account" "account_synapse" {
  name                     = "n3tworkstoragesynapse"
  resource_group_name      = azurerm_resource_group.rg.name
  location                 = azurerm_resource_group.rg.location
  account_tier             = "Standard"
  account_replication_type = "LRS"
  account_kind             = "StorageV2"
  is_hns_enabled           = "true"
}

resource "azurerm_storage_data_lake_gen2_filesystem" "lake" {
  name               = "n3tworklake"
  storage_account_id = azurerm_storage_account.account_synapse.id
}

resource "azurerm_synapse_workspace" "azurerm_synapse_workspace" {
  name                                 = "n3tworksynapse"
  resource_group_name                  = azurerm_resource_group.rg.name
  location                             = azurerm_resource_group.rg.location
  storage_data_lake_gen2_filesystem_id = azurerm_storage_data_lake_gen2_filesystem.lake.id
  sql_administrator_login              = "sqladminuser"
  sql_administrator_login_password     = "H@Sh1CoR3!"

  identity {
    type = "SystemAssigned"
  }
}

resource "azurerm_app_service_plan" "funcapp" {
  name                = "webshopAPI"
  location            = azurerm_resource_group.rg.location
  resource_group_name = azurerm_resource_group.rg.name
  kind                = "FunctionApp"

  sku {
    tier     = "Dynamic"
    size     = "Y1"  # "Y1" is the correct size for a consumption plan
    capacity = 0
  }
}

resource "azurerm_function_app" "funcapp" {
  name                       = "webshopfunc"
  location                   = azurerm_resource_group.rg.location
  resource_group_name        = azurerm_resource_group.rg.name
  app_service_plan_id        = azurerm_app_service_plan.funcapp.id
  storage_account_name       = azurerm_storage_account.storage.name
  storage_account_access_key = azurerm_storage_account.storage.primary_access_key
  os_type                    = "linux"  # Ensure the Function App runs on Linux
  version                    = "~4"     # Use version "~4" for the latest supported runtime

  app_settings = {
    "FUNCTIONS_WORKER_RUNTIME" = "python"  # Specify Python as the worker runtime
    "WEBSITE_RUN_FROM_PACKAGE" = "1"
  }
}
