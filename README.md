# Rol Tabanlı Destek Talep Yönetim Sistemi

Bu proje, PHP ve MySQL kullanılarak geliştirilmiş web tabanlı bir destek talep yönetim sistemidir. Sistem, **kullanıcı** ve **admin** rollerine göre farklı yetkilere sahiptir. Kullanıcılar kayıt olabilir, giriş yapabilir, destek talebi oluşturabilir ve kendi taleplerini görüntüleyebilir. Admin ise tüm talepleri listeleyebilir, detaylarını inceleyebilir ve durum güncellemesi yapabilir.

## Proje Özeti

Projede aşağıdaki temel işlevler bulunmaktadır:

- Kullanıcı kayıt olma
- Kullanıcı giriş yapma / çıkış yapma
- Session tabanlı oturum yönetimi
- Rol tabanlı yetkilendirme
- Destek talebi oluşturma
- Kullanıcının kendi taleplerini görüntülemesi
- Admin paneli üzerinden tüm talepleri görüntüleme
- Talep detaylarını inceleme
- Talep durumu ve çözüm notu güncelleme

## Kullanılan Teknolojiler

- PHP
- MySQL
- HTML
- CSS
- XAMPP
- phpMyAdmin

## Kullanıcı Rolleri

### User
- Kayıt olabilir
- Giriş yapabilir
- Yeni destek talebi oluşturabilir
- Sadece kendi destek taleplerini görüntüleyebilir

### Admin
- Giriş yapabilir
- Dashboard sayfasını görüntüleyebilir
- Tüm destek taleplerini listeleyebilir
- Talep detay sayfasını görüntüleyebilir
- Talep durumunu ve çözüm notunu güncelleyebilir

## Proje Dosya Yapısı

- `register.php` → Kullanıcı kayıt sayfası
- `login.php` → Giriş sayfası
- `logout.php` → Çıkış işlemi
- `auth_check.php` → Giriş kontrolü
- `admin_check.php` → Admin yetki kontrolü
- `create_ticket.php` → Yeni destek talebi oluşturma
- `store_ticket.php` → Destek talebini veritabanına kaydetme
- `my_tickets.php` → Kullanıcının kendi taleplerini görüntülediği sayfa
- `dashboard.php` → Admin dashboard sayfası
- `list_tickets.php` → Tüm destek taleplerinin listesi
- `ticket_detail.php` → Talep detay sayfası
- `update_ticket.php` → Talep güncelleme işlemi
- `header.php` → Ortak üst menü / çıkış bağlantısı
- `db.php` → Veritabanı bağlantısı
- `style.css` → Arayüz stilleri

## Veritabanı Yapısı

Projede temel olarak iki tablo kullanılmaktadır:

### `users`
- `id`
- `full_name`
- `email`
- `password`
- `role`
- `created_at`

### `tickets`
- `id`
- `title`
- `description`
- `category`
- `priority`
- `status`
- `created_by`
- `resolution_note`
- `created_at`
- `updated_at`

## Projenin Çalıştırılması

### 1. XAMPP Kurulumu
Bilgisayarınızda XAMPP kurulu olmalıdır.

### 2. Apache ve MySQL'i Başlatın
XAMPP Control Panel üzerinden:
- Apache
- MySQL

servislerini çalıştırın.

### 3. Proje Klasörünü Doğru Dizin İçine Taşıyın
Proje klasörünü XAMPP içindeki `htdocs` klasörüne koyun.

Örnek:
```bash
C:\xampp\htdocs\TicketSystem
