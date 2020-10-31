# srvctl

A mini tool to quickly perform certain actions on a server.

## Requirements
### `sudo` for `www-data`
As `fail2ban-client` needs to be run as root, the PHP user (`www-data`) needs to be able to execute `sudo` for a specific set of commands. 

To configure this, add the following line to `/etc/sudoers`:

```
www-data ALL=NOPASSWD: /usr/bin/fail2ban-client
```

**Don't forget to protect this script with basic auth!**