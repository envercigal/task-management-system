
# Proje Kurulum Rehberi

## Manuel Kurulum

1. `.env.example` dosyasını `.env` olarak kopyalayın.
   ```bash
   cp .env.example .env
   ```

2. Veritabanı bilgilerini `.env` dosyasına girin.

3. Gerekli paketleri yükleyin:
   ```bash
   composer install
   ```

4. Veritabanı tablolarını oluşturun:
   ```bash
   php artisan migrate
   ```

5. Gerekli görevleri oluşturmak için komutu çalıştırın:
   ```bash
   php artisan app:task-create
   ```

6. Uygulamayı başlatın:
   ```bash
   php artisan serve
   ```

## Docker ile Kurulum

1. `.env.example` dosyasını `.env` olarak kopyalayın (docker için gerekli veritabanı ayarlarını içerir).
   ```bash
   cp .env.example .env
   ```

2. Docker konteynerlerini başlatın:
   ```bash
   docker-compose up
   ```

### Notlar
- Manuel kurulum yapıyorsanız `.env` dosyasındaki veritabanı bilgilerini manuel olarak doldurmayı unutmayın.
- Docker kullanıyorsanız `.env` dosyasındaki veritabanı ayarlarını docker'a göre yapılandırın. (.env.example bu bilgiyi içerir)
