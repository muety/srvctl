<!DOCTYPE html>
<html lang="en" class="flex flex-col">

<head>
    <title>SrvCtl</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
</head>

    <body class="flex flex-col flex-grow p-2">
        <div class="flex flex-col flex-grow items-center">
            <header class="mb-4">
                <h1>⚙️ SrvCtl</h1>
            </header>

            <div class="<?php echo $successAlert != '' ? 'block' : 'hidden'; ?> mb-4 flex">
                <div class="flex-grow bg-success p-1 rounded text-center">
                    <strong>Success!</strong> <?= $successAlert ?>
                </div>
            </div>

            <div class="<?php echo $dangerAlert != '' ? 'block' : 'hidden'; ?> mb-4 flex">
                <div class="flex-grow bg-danger p-1 rounded text-center">
                    <strong>Error!</strong> <?= $dangerAlert ?>
                </div>
            </div>

            <main class="flex flex-col items-center flex-grow">
                <section class="flex flex-col items-center">
                    <h2>🚫 Fail2Ban</h2>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_ignore_ip"/>
                            <input type="hidden" name="args[]" value="" class="ip4-input"/>
                            <button type="submit">Ignore my IPv4</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unignore_ip"/>
                            <input type="hidden" name="args[]" value="" class="ip4-input"/>
                            <button type="submit">Unignore my IPv4</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unban_ip"/>
                            <input type="hidden" name="args[]" value="" class="ip4-input"/>
                            <button type="submit">Unban my IPv4</button>
                        </form>
                    </div>

                    <div style="margin-bottom: 30px;"></div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_ignore_ip"/>
                            <input type="hidden" name="args[]" value="" class="ip6-input"/>
                            <button type="submit">Ignore my IPv6</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unignore_ip"/>
                            <input type="hidden" name="args[]" value="" class="ip6-input"/>
                            <button type="submit">Unignore my IPv6</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unban_ip"/>
                            <input type="hidden" name="args[]" value="" class="ip6-input"/>
                            <button type="submit">Unban my IPv6</button>
                        </form>
                    </div>

                    <div style="margin-bottom: 30px;"></div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unban_all"/>
                            <button type="submit">Unban all</button>
                        </form>
                    </div>
                </section>
            </main>

            <footer class="text-sm text-center">
                IPv4: <span id="ip4-indicator"></span><br>
                IPv6: <span id="ip6-indicator"></span><br>
                IP (server): <?= $clientIp ?><br>
                PHP: <?= $phpVersion ?>
            </footer>
        </div>

        <script>
            function on4({ ip }) {
                document.querySelector('#ip4-indicator').innerText = ip;
                [...document.querySelectorAll('.ip4-input')].forEach(e => e.value = ip);
            }

            function on6({ ip }) {
                document.querySelector('#ip6-indicator').innerText = ip;
                [...document.querySelectorAll('.ip6-input')].forEach(e => e.value = ip);
            }
        </script>

        <script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=on4" defer></script>
        <script type="application/javascript" src="https://api6.ipify.org?format=jsonp&callback=on6" defer></script>
    </body>

</html>