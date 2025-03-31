# Blog API 文件

## Base URL
```
http://localhost:3000/api
```

## 認證相關
所有需要認證的 API 都需要在 Header 中加入 Bearer Token：
```
Authorization: Bearer <token>
```

## API 端點

### 文章相關 API

#### 1. 取得文章列表
```
GET /articles
```

Query Parameters:
- `page`: number (預設: 1) - 當前頁碼
- `limit`: number (預設: 10) - 每頁數量
- `category`: string (可選) - 文章類型 ('tech' | 'life' | 'book-review')
- `tag`: string (可選) - 標籤篩選
- `search`: string (可選) - 搜尋關鍵字

Response 200:
```json
{
  "data": [
    {
      "id": "string",
      "title": "string",
      "summary": "string",
      "content": "string",
      "category": "tech | life | book-review",
      "tags": ["string"],
      "coverImage": "string",
      "createdAt": "string",
      "updatedAt": "string"
    }
  ],
  "pagination": {
    "total": "number",
    "page": "number",
    "limit": "number",
    "totalPages": "number"
  }
}
```

#### 2. 取得單一文章
```
GET /articles/:id
```

Response 200:
```json
{
  "id": "string",
  "title": "string",
  "summary": "string",
  "content": "string",
  "category": "tech | life | book-review",
  "tags": ["string"],
  "coverImage": "string",
  "createdAt": "string",
  "updatedAt": "string"
}
```

#### 3. 創建文章 (需要認證)
```
POST /articles
```

Request Body:
```json
{
  "title": "string",
  "summary": "string",
  "content": "string",
  "category": "tech | life | book-review",
  "tags": ["string"],
  "coverImage": "string"
}
```

Response 201:
```json
{
  "id": "string",
  "title": "string",
  "summary": "string",
  "content": "string",
  "category": "tech | life | book-review",
  "tags": ["string"],
  "coverImage": "string",
  "createdAt": "string",
  "updatedAt": "string"
}
```

#### 4. 更新文章 (需要認證)
```
PUT /articles/:id
```

Request Body:
```json
{
  "title": "string",
  "summary": "string",
  "content": "string",
  "category": "tech | life | book-review",
  "tags": ["string"],
  "coverImage": "string"
}
```

Response 200:
```json
{
  "id": "string",
  "title": "string",
  "summary": "string",
  "content": "string",
  "category": "tech | life | book-review",
  "tags": ["string"],
  "coverImage": "string",
  "createdAt": "string",
  "updatedAt": "string"
}
```

#### 5. 刪除文章 (需要認證)
```
DELETE /articles/:id
```

Response 204: No Content

### 標籤相關 API

#### 1. 取得所有標籤
```
GET /tags
```

Response 200:
```json
{
  "data": [
    {
      "id": "string",
      "name": "string",
      "articleCount": "number"
    }
  ]
}
```

### 錯誤處理

所有 API 在發生錯誤時會返回以下格式：
```json
{
  "status": "number",
  "message": "string",
  "errors": {
    "field": "error message"
  }
}
```

常見錯誤碼：
- 400: Bad Request - 請求格式錯誤
- 401: Unauthorized - 未認證或認證失敗
- 403: Forbidden - 無權限訪問
- 404: Not Found - 資源不存在
- 500: Internal Server Error - 伺服器錯誤

## 資料模型

### Article
```typescript
interface Article {
  id: string;
  title: string;
  summary: string;
  content: string;
  category: 'tech' | 'life' | 'book-review';
  tags: string[];
  coverImage: string;
  createdAt: Date;
  updatedAt: Date;
}
```

### Tag
```typescript
interface Tag {
  id: string;
  name: string;
  articleCount: number;
}
``` 