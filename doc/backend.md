# 部落格後端開發文件

## 專案概述
- 專案類型：個人部落格
- 架構：前後端分離
- 前端技術：Vue 3 + TypeScript + Vite
- 後端技術：Laravel
- API 文件：[查看 API 文件](./api.md)

## 目前進度
1. 前端開發
   - 已完成基本頁面結構
   - 已實作文章列表和詳細頁面
   - 使用模擬資料（mock data）進行開發

2. 後端開發（待開發）
   - 需要建立新的 Laravel 專案
   - 實作 API 端點
   - 設定資料庫結構

## 下一步開發任務

### 1. 建立 Laravel 專案
- 建立新的 Laravel 專案
- 設定開發環境
- 設定資料庫連接
- 設定 CORS 允許前端存取

### 2. 資料庫設計
```sql
-- 文章表
articles
  - id (primary key)
  - title (string)
  - summary (text)
  - content (text)
  - type (enum: 'tech', 'life', 'book-review')
  - cover_image (string)
  - created_at (timestamp)
  - updated_at (timestamp)

-- 標籤表
tags
  - id (primary key)
  - name (string)
  - created_at (timestamp)
  - updated_at (timestamp)

-- 文章標籤關聯表
article_tag
  - article_id (foreign key)
  - tag_id (foreign key)
```

### 3. API 實作順序
1. 文章相關 API
   - GET /articles（文章列表）
   - GET /articles/{id}（單一文章）
   - POST /articles（創建文章）
   - PUT /articles/{id}（更新文章）
   - DELETE /articles/{id}（刪除文章）

2. 標籤相關 API
   - GET /tags（取得所有標籤）

### 4. 認證機制
- 使用 Laravel Sanctum 實作 API 認證
- 只有管理員可以新增/修改/刪除文章
- 讀取文章和標籤不需要認證

## 開發注意事項

### 1. CORS 設定
```php
// config/cors.php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'], // 前端開發伺服器
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
```

### 2. 回應格式標準化
```php
// 成功回應
{
    "data": {
        // 資料內容
    },
    "pagination": {  // 如果有分頁
        "total": number,
        "page": number,
        "limit": number,
        "totalPages": number
    }
}

// 錯誤回應
{
    "status": number,
    "message": string,
    "errors": {
        // 錯誤詳情
    }
}
```

### 3. 資料驗證規則
```php
// 文章驗證規則
[
    'title' => 'required|string|max:255',
    'summary' => 'required|string',
    'content' => 'required|string',
    'type' => 'required|in:tech,life,book-review',
    'tags' => 'array',
    'tags.*' => 'string|exists:tags,name',
    'coverImage' => 'required|string'
]
```

## 部署考慮
1. 資料庫遷移檔案要完整記錄所有結構變更
2. 環境變數設定要完整（.env.example）
3. API 文件要保持更新
4. 需要設定正式環境的 CORS 設定

## 測試計劃
1. 單元測試
   - 文章 CRUD 操作
   - 標籤操作
   - 資料驗證

2. 整合測試
   - API 端點測試
   - 認證機制測試
   - 資料關聯測試

## 未來優化方向
1. 加入快取機制
2. 實作全文搜尋
3. 圖片上傳功能
4. 文章版本控制
5. 評論功能

## 相關資源
- [Laravel 文件](https://laravel.com/docs)
- [API 規格文件](./api.md)
- [前端專案 README](../README.md) 