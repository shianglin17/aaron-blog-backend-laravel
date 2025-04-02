# 資料庫結構文件

## Articles 表

| 欄位名稱 | 型別 | 描述 | 備註 |
|---------|------|------|------|
| id | bigint unsigned | 文章唯一識別碼 | 主鍵，自動遞增 |
| title | string | 文章標題 | - |
| content | text | 文章內容 | - |
| status | enum | 文章狀態 | 可選值：draft（草稿）, published（已發布）, archived（已封存）<br>預設值：draft |
| published_at | timestamp | 發布時間 | 可為空 |
| created_at | timestamp | 建立時間 | 自動維護 |
| updated_at | timestamp | 更新時間 | 自動維護 |
| deleted_at | timestamp | 軟刪除時間 | 可為空，用於軟刪除功能 |

### 待新增欄位（根據 API 文件規範）

| 欄位名稱 | 型別 | 描述 | 備註 |
|---------|------|------|------|
| summary | text | 文章摘要 | - |
| category | enum | 文章分類 | 可選值：tech（技術）, life（生活）, book-review（書評） |
| cover_image | string | 封面圖片 | 儲存圖片路徑或 URL |

### 關聯表（待建立）

#### article_tags 表（文章標籤關聯表）

| 欄位名稱 | 型別 | 描述 | 備註 |
|---------|------|------|------|
| article_id | bigint unsigned | 文章 ID | 外鍵，關聯 articles 表 |
| tag_id | bigint unsigned | 標籤 ID | 外鍵，關聯 tags 表 |

#### tags 表

| 欄位名稱 | 型別 | 描述 | 備註 |
|---------|------|------|------|
| id | bigint unsigned | 標籤唯一識別碼 | 主鍵，自動遞增 |
| name | string | 標籤名稱 | 唯一值 |
| created_at | timestamp | 建立時間 | 自動維護 |
| updated_at | timestamp | 更新時間 | 自動維護 |

## 索引設計

### articles 表
- `articles_title_index`: 標題索引，用於搜尋優化
- `articles_published_at_index`: 發布時間索引，用於排序和篩選
- `articles_status_index`: 狀態索引，用於篩選

### article_tags 表
- `article_tags_article_id_tag_id_unique`: 複合唯一索引，確保文章和標籤的組合不重複

### tags 表
- `tags_name_unique`: 標籤名稱唯一索引 