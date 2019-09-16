Manage FTP accounts in the GameAP

## Installation

### Via Composer

Install ftp module:
```bash
composer require --no-update gameap/ftp-module "^1.1"
```

Update migrations:
```bash
php artisan module:migrate Ftp
```

### Without access to CLI (SSH or other)

Copy files to `/path/to/gameap/modules/Ftp/`

Update migrations. Go to **GameAP** -> **Modules** and click **"Run Migration"**
