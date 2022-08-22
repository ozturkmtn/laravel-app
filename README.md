

## Proje Hakkında

Basit bir paket yönetim sistemidir.

- Projeyi Docker ile çalıştırabilirsiniz. "./vendor/bin/sail up" ana dizinde komutu yeterli oluyor.
- Süresi bitmiş paketlerin kontrolü Command ile kontrol edilip,  queue ya yollanıyor.
- Command çalıştırmak için bir Cron eklenmesi gerekiyor.
- Yada "php artisan command:check-packages" komutu ile çalıştırılabilir.
- Queue için database queue kullandım. Büyük bir projede SQS yada Rabbit kullanılabilir.
- Queue yu başlatmak için "php artisan queue:work" komutu ile çalıştırmak gerekiyor.


Laravel ile ilk kez proje geliştirdiğim için Service katmanı kullanmadan yaptım. 
Bilgi eksikliğinden bazı kısımları eksik yapmış veya bazı kısımları atlamış olabilirim.

İyi Çalışmalar.

