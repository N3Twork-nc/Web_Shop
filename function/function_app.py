import azure.functions as func
import logging
import mysql.connector
import json
from decimal import Decimal
from datetime import datetime
app = func.FunctionApp(http_auth_level=func.AuthLevel.FUNCTION)


class DecimalEncoder(json.JSONEncoder): 
    def default(self, obj): 
        if isinstance(obj, Decimal): 
            return float(obj)
        return super(DecimalEncoder, self)

@app.route(route="list-products", methods=["GET"])
def http_trigger(req: func.HttpRequest) -> func.HttpResponse:
    logging.info('Get list products.')
    try:
        # Ket noi MySQL voi Python bang ham mysql.connector.connect()
        mydb = mysql.connector.connect(
            host="n3tworkdb.mysql.database.azure.com", 
            user="n3twork",
            password="n3twork@",
            database="ptit_shop"
        )
        mycursor = mydb.cursor()
        mycursor.execute("SELECT * FROM products")
        # Lấy cột (header) và dữ liệu
        columns = [column[0] for column in mycursor.description]  # Lấy tên các cột từ câu lệnh SELECT
        results = mycursor.fetchall()

        # Chuyển đổi dữ liệu sang danh sách từ điển
        data = [dict(zip(columns, row)) for row in results]
        for item in data: 
            for key in item: 
                if isinstance(item[key], Decimal): 
                    item[key] = float(item[key])
                if isinstance(item[key], datetime): 
                    item[key] =  item[key].isoformat()

        # Chuyển kết quả về JSON
        json_result = json.dumps(data)  # indent=4 để dễ đọc
        return func.HttpResponse(json_result)
    except Exception as e:  # Bắt mọi lỗi và lưu thông tin lỗi
        return func.HttpResponse(f"Lỗi: {str(e)}")