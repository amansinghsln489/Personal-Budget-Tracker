# Laravel HRLM Project README

Welcome to the Laravel HRLM project! This README provides essential setup instructions, commands, and configurations.

## Firewall and IP Forwarding Setup

### Check Firewall Status and Allow Port 8000

```bash
sudo ufw status
sudo ufw allow 8000/tcp

# Start Laravel Development Server

php artisan serve --host=0.0.0.0 --port=8000

# Verify IP Address
ip addr show | grep inet


# Accessing Your Laravel Application
http://192.168.29.147:8000/dashboard




# Wi-Fi Network Configuration
# Ensure that your Wi-Fi network is not blocking connections. Adjust settings as necessary to allow access to your Laravel application.

php artisan cache:clear
php artisan route:cache

##########################################################################################3
Git commands

git clone https://github.com/ashutoshbluethink/InternalLeadManagement

username: ashutoshbluethink
password: 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

