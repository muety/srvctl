<!DOCTYPE html>
<html lang="en" class="flex flex-col">

<head>
    <title>⚙️ SrvCtl</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
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
                            <input type="hidden" name="action" value="fail2ban_ignore_me"/>
                            <button type="submit">Ignore my IP</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unignore_me"/>
                            <button type="submit">Unignore my IP</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unban_me"/>
                            <button type="submit">Unban my IP</button>
                        </form>
                    </div>

                    <div class="my-1">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fail2ban_unban_all"/>
                            <button type="submit">Unban all</button>
                        </form>
                    </div>
                </section>
            </main>

            <footer class="text-sm text-center">
                IP: <?= $clientIp ?><br>
                PHP: <?= $phpVersion ?>
            </footer>
        </div>
    </body>

</html>