

## Proje Hakkında

Basit bir paket yönetim sistemidir.

- Süresi bitmiş paketlerin kontrolü Command ile kontrol edilip,  queue ya yollanıyor.
- Command çalıştırmak için bir Cron eklenmesi gerekiyor.
- Yada "php artisan command:check-packages" komutu ile çalıştırılabilir.
- Queue için database queue kullandım. Büyük bir projede SQS yada Rabbit kullanılabilir.
- Queue yu başlatmak için "php artisan queue:work" komutu ile çalıştırmak gerekiyor.


Laravel ile ilk kez proje geliştirdiğim için Service katmanı ve bazı kısımları atlamış olabilirim.

