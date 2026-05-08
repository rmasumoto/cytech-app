# Cytech EC 仕様書

## 目次
1. [テーブル設計](#テーブル設計)
2. [機能一覧](#機能一覧)
3. [画面遷移](#画面遷移)

---

## テーブル設計

### users（ユーザー）

| カラム名 | 論理名 | 型 | NULL | PK | FK |
|---|---|---|---|---|---|
| id | ID | bigint | NO | ○ | |
| name | ユーザ名 | varchar(255) | NO | | |
| name_kanji | 漢字名 | varchar(255) | YES | | |
| name_kana | カナ名 | varchar(255) | YES | | |
| email | メールアドレス | varchar(255) | NO | | |
| password | パスワード | varchar(255) | NO | | |
| company_id | 会社ID | bigint | YES | | companies.id |
| created_at | 作成日 | timestamp | YES | | |
| updated_at | 更新日 | timestamp | YES | | |

---

### companies（会社）

| カラム名 | 論理名 | 型 | NULL | PK | FK |
|---|---|---|---|---|---|
| id | ID | bigint | NO | ○ | |
| company_name | 会社名 | varchar(255) | NO | | |
| created_at | 作成日 | timestamp | YES | | |
| updated_at | 更新日 | timestamp | YES | | |

---

### products（商品）

| カラム名 | 論理名 | 型 | NULL | PK | FK |
|---|---|---|---|---|---|
| id | ID | bigint | NO | ○ | |
| user_id | ユーザID | bigint | NO | | users.id |
| company_id | 会社ID | bigint | YES | | companies.id |
| product_name | 商品名 | varchar(255) | NO | | |
| price | 金額 | int | NO | | |
| stock | 在庫数 | int | NO | | |
| description | 説明 | varchar(255) | YES | | |
| img_path | 画像 | varchar(255) | YES | | |
| created_at | 作成日 | timestamp | YES | | |
| updated_at | 更新日 | timestamp | YES | | |

---

### sales（購入）

| カラム名 | 論理名 | 型 | NULL | PK | FK |
|---|---|---|---|---|---|
| id | ID | bigint | NO | ○ | |
| user_id | ユーザID | bigint | NO | | users.id |
| product_id | 商品ID | bigint | NO | | products.id |
| quantity | 個数 | bigint | NO | | |
| created_at | 作成日 | timestamp | YES | | |
| updated_at | 更新日 | timestamp | YES | | |

---

### likes（お気に入り）

| カラム名 | 論理名 | 型 | NULL | PK | FK |
|---|---|---|---|---|---|
| id | ID | bigint | NO | ○ | |
| user_id | ユーザID | bigint | NO | | users.id |
| product_id | 商品ID | bigint | NO | | products.id |
| created_at | 作成日 | timestamp | YES | | |
| updated_at | 更新日 | timestamp | YES | | |

---

## 機能一覧

### 1. ログイン画面 `/login`

| 項目 | 種別 | 説明 |
|---|---|---|
| メールアドレス | テキストボックス | users.email と照合 |
| パスワード | パスワード入力欄 | users.password と照合 |
| ログインボタン | ボタン | 認証成功で商品一覧へ遷移 |

---

### 2. 新規ユーザ登録画面 `/register`

| 項目 | 種別 | 説明 | 必須 |
|---|---|---|---|
| Name（ユーザ名） | テキストボックス | users.name | ○ |
| 名前（漢字） | テキストボックス | users.name_kanji | |
| 名前（カナ） | テキストボックス | users.name_kana（カタカナのみ） | |
| メールアドレス | テキストボックス | users.email（重複不可） | ○ |
| パスワード | パスワード入力欄 | users.password（8文字以上） | ○ |
| パスワード（確認用） | パスワード入力欄 | パスワードと一致しない場合エラー | ○ |
| 登録ボタン | ボタン | 登録後、商品一覧へ遷移 | |

---

### 3. 商品一覧画面 `/`

| 項目 | 種別 | 説明 |
|---|---|---|
| 商品名 | テキストボックス（検索） | 部分一致で検索 |
| 最低価格 | テキストボックス（検索） | products.price の下限 |
| 最高価格 | テキストボックス（検索） | products.price の上限 |
| 検索ボタン | ボタン | 非同期処理で同一画面に結果を表示 |
| 商品番号 | 固定表示 | products.id |
| 商品名 | 固定表示 | products.product_name |
| 商品説明 | 固定表示 | products.description |
| 画像 | 固定表示 | products.img_path |
| 料金(¥) | 固定表示 | products.price |
| 詳細ボタン | ボタン | 押下時、商品詳細画面へ遷移 |

---

### 4. 商品詳細画面 `/products/{id}`

| 項目 | 種別 | 説明 |
|---|---|---|
| 商品名 | 固定表示 | products.product_name |
| 説明 | 固定表示 | products.description |
| 画像 | 固定表示 | products.img_path |
| 金額 | 固定表示 | products.price |
| 会社 | 固定表示 | companies.company_name |
| お気に入り | ボタン | likesテーブルを操作（トグル） |
| カートに追加するボタン | ボタン | 押下時、購入画面へ遷移 |
| 戻るボタン | ボタン | 押下時、商品一覧へ遷移 |

---

### 5. 購入画面 `/products/{id}/purchase`

| 項目 | 種別 | 説明 |
|---|---|---|
| 商品名 | 固定表示 | products.product_name |
| 説明 | 固定表示 | products.description |
| 画像 | 固定表示 | products.img_path |
| 金額 | 固定表示 | products.price |
| 会社名 | 固定表示 | companies.company_name |
| 個数 | テキストボックス | sales.quantity（在庫数以内） |
| 購入するボタン | ボタン | salesテーブルに登録、products.stockを減算し商品一覧へ遷移 |
| 戻るボタン | ボタン | 押下時、商品詳細へ遷移 |

---

### 6. 商品新規登録画面 `/mypage/products/create`

| 項目 | 種別 | 説明 | 必須 |
|---|---|---|---|
| 商品名 | テキストボックス | products.product_name | ○ |
| 価格 | テキストボックス | products.price | ○ |
| 商品説明 | テキストエリア | products.description | |
| 在庫数 | テキストボックス | products.stock | ○ |
| 商品画像 | ファイルセレクタ | products.img_path | |
| 登録ボタン | ボタン | 登録後、マイページへ遷移 |  |
| 戻るボタン | ボタン | マイページへ遷移 | |

---

### 7. 出品商品詳細画面 `/mypage/products/{id}`

| 項目 | 種別 | 説明 |
|---|---|---|
| 商品名 | 固定表示 | products.product_name |
| 説明 | 固定表示 | products.description |
| 画像 | 固定表示 | products.img_path |
| 金額 | 固定表示 | products.price |
| 編集ボタン | ボタン | 商品編集画面へ遷移 |
| 削除するボタン | ボタン | 削除確認後、productsを削除しマイページへ遷移 |
| 戻るボタン | ボタン | マイページへ遷移 |

---

### 8. 商品編集画面 `/mypage/products/{id}/edit`

| 項目 | 種別 | 説明 | 必須 |
|---|---|---|---|
| 商品名 | テキストボックス | 初期値あり products.product_name | ○ |
| 価格 | テキストボックス | 初期値あり products.price | ○ |
| 商品説明 | テキストエリア | 初期値あり products.description | |
| 在庫数 | テキストボックス | 初期値あり products.stock | ○ |
| 商品画像 | ファイルセレクタ | 現在画像プレビューあり | |
| 更新ボタン | ボタン | 更新後、マイページへ遷移 | |
| 戻るボタン | ボタン | 出品商品詳細へ遷移 | |

---

### 9. お問い合わせフォーム `/contact`

| 項目 | 種別 | 説明 | 必須 |
|---|---|---|---|
| 名前 | テキストボックス | お問い合わせ者氏名 | ○ |
| メールアドレス | テキストボックス | 返信先メールアドレス | ○ |
| お問い合わせ内容 | テキストエリア | 問い合わせ本文 | ○ |
| 送信ボタン | ボタン | 管理者宛にメール送信後、商品一覧へ遷移 | |
| 戻るボタン | ボタン | 商品一覧へ遷移 | |

---

### 10. マイページ `/mypage`

| 項目 | 種別 | 説明 |
|---|---|---|
| アカウント編集ボタン | ボタン | アカウント編集画面へ遷移 |
| ユーザ名 | 固定表示 | users.name |
| Eメール | 固定表示 | users.email |
| 名前 | 固定表示 | users.name_kanji |
| カナ | 固定表示 | users.name_kana |
| 出品商品一覧 | テーブル | 自分が出品した商品一覧（詳細ボタンで出品商品詳細へ） |
| 新規登録ボタン | ボタン | 商品新規登録画面へ遷移 |
| 購入した商品一覧 | テーブル | salesテーブルから取得（商品名・説明・料金・個数） |

---

### 11. アカウント情報編集画面 `/account/edit`

| 項目 | 種別 | 説明 | 必須 |
|---|---|---|---|
| ユーザ名 | テキストボックス | 初期値あり users.name | ○ |
| Eメール | テキストボックス | 初期値あり users.email（重複不可） | ○ |
| 名前 | テキストボックス | 初期値あり users.name_kanji | |
| カナ | テキストボックス | 初期値あり users.name_kana | |
| 更新ボタン | ボタン | 更新後、マイページへ遷移 | |
| 戻るボタン | ボタン | マイページへ遷移 | |

---

## 画面遷移

```
ログイン ──────────────────────────────→ 商品一覧
   ↕ 新規登録                              ↕ 詳細
新規ユーザ登録                          商品詳細
                                           ↓ カートに追加する
                                        購入画面

ヘッダー → マイページ / Home（商品一覧）
フッター → お問い合わせ / Home / マイページ

マイページ → 新規登録 → 商品新規登録
         → 詳細     → 出品商品詳細 → 編集 → 商品編集
                                   → 削除
         → アカウント編集
```
