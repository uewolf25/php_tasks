# php_tasks
- `openapi.yaml`を満たすようなプログラム。

## 環境
- Docker
  - MySQL 5.7
  - PHP 7.4.7-fpm-alpine
  - Nginx 1.17.3
- slim4.0

## 実行方法
```
cd docker
docker-compose up -d
```
Access→ [http://localhost](http://localhost)

```
docker-compose down
```

## 取得方法

### Get list
全件取得。  
`curl -X GET "http://localhost/tasks" -H  "accept: application/json"`

### Post 
ポスト。(例は桃太郎)  
```
curl -X POST "http://localhost/tasks" -H  "accept: application/json" -H  "Content-Type: application/json" -d "{  \"title\": \"Peach Boy\",  \"description\": \"Long, long ago, there lived an old man and his old wife in avillage.\"}"
```

### Get by id
任意のIDから情報を取得。(例)id=1のデータを取得。  
```
curl -X GET "http://localhost/tasks/1" -H  "accept: application/json"
```

### Put
任意のIDの情報を更新する。(例)id=1のデータを更新  
```
curl -X PUT "http://localhost/tasks/1" -H  "accept: application/json" -H  "Content-Type: application/json" -d "{\"id\":1,\"title\":\"Then Anyone has been gone .\",\"description\":\"Nobady knows\"}"
```

### Delete
任意のIDの情報を削除する。(例)id=1のデータを削除
```
curl -X DELETE "http://localhost/tasks/1" -H  "accept: application/json"
```

