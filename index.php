<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/css/main.css">
    <link rel="stylesheet" href="/static/css/aside.css">
    <title>Document</title>
</head>
<?php
require_once "db-controller.php";
$_id = $_GET['_id'] ?? '1';

$user = findUserByID($_id);
// echo "$user";
?>

<body>
    <section class="aside">

        <div href="#" class="aside__logo">
            <a href="#"><img src="/static/img/Logo.svg" alt="logo"></a>
        </div>

        <div class="nav-settings">

            <div class="nav">

                <a href="#" class="link-wrapper">
                    <div class="link">
                        <img src="/static/img/home.svg">
                        <span>home</span>
                    </div>
                </a>

                <a href="#" class="link-wrapper">
                    <div class="link">
                        <img src="/static/img/anal.svg">
                        <span>analytics</span>
                    </div>
                </a>

                <a href="#" class="link-wrapper">
                    <div class="link">
                        <img src="/static/img/wallet.svg">
                        <span>Wallets</span>
                    </div>
                </a>

                <a href="#" class="link-wrapper">
                    <div class="link">
                        <img src="/static/img/inv.svg">
                        <span>Invoices</span>
                    </div>
                </a>

                <a href="#" class="link-wrapper">
                    <div class="link">
                        <img src="/static/img/acc.svg">
                        <span>Account</span>
                    </div>
                </a>

                <a href="#" class="link-wrapper">
                    <div class="link">
                        <img src="/static/img/set.svg">
                        <span>Settings</span>
                    </div>
                </a>


            </div>


            <div class="settings">
                <div class="settings-link">
                    <img src="/static/img/11.svg">
                    <span>Get help</span>
                </div>

                <div class="switch-container">
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>

                    <div class="toggel">Dark mode</div>
                </div>

            </div>
        </div>



    </section>






    <section class="center-block">


        <section class="overview">
            <div class="money-overview">
                <div class="overview-title">Overview</div>
                <div class="money-container">
                    <div class="money-infos">
                        <div class="balance-container">
                            <div class="credit-limit">
                                <div class="balance-wrapper">
                                    <div class="b-text">Total Balance</div>
                                    <img src="/static/img/Rectangle 5689.svg" alt="" class="b-line">
                                </div>
                                <div class="balance">$<?= $user["balance"] ?></div>
                            </div>
                            <div class="credit-limit">
                                <div class="balance-wrapper">
                                    <div class="b-text">Total Balance</div>
                                    <img src="/static/img/Rectangle 5689.svg" alt="" class="b-line">
                                </div>
                                <div class="balance-2">$<?= $user["balance"] ?></div>
                            </div>
                        </div>
                        <a href="" class="button">Make a payment</a>
                    </div>
                    <img src="/static/img/Graphic.svg" class="graphic">
                </div>
        </section>

        <section class="center-bottom">

            <section class="Transactions">
                <div class="tr-text">Transactions</div>
                <div class="nav-bar">
                    <div class="toogle_tab">
                        <a href="" class="categories_all selected">All</a>
                        <a href="" class="categories_upcoming">Upcoming</a>
                    </div>
                    <a href="" class="filter-button">
                        <img src="/static/img/Frame.svg" alt="celendar" class="calendar">
                        <div class="month">May</div>
                        <img src="/static/img/Vector.svg" alt="arrow" class="calendar-arrow">
                    </a>
                </div>
                <div class="story">
                    <div class="date">May 23, 2022</div>
                    <?php $stmt = $pdo->prepare("SELECT * FROM transactions WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC");
                    $stmt->execute([$_id, $_id]);
                    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($transactions as $transaction):
                        $isSender = $transaction["sender_id"] == $_id;
                        $amount = $isSender ? "-$" . number_format($transaction["amount"], 2) : "+$" . number_format($transaction["amount"], 2);
                        $category = "Transfer";
                        ?>
                        <div class="transaction-place">
                            <div class="left">
                                <div class="left-left">
                                    <img src="/static/img/icon-service.svg" alt="place">
                                    <div class="place-info">
                                        <div class="info-place">
                                            <?= htmlspecialchars($transaction["receiver_name"] ?? "Unknown") ?>
                                        </div>
                                        <div class="place-date">
                                            <?= date("M d, Y \\a\\t h:i A", strtotime($transaction["transaction_time"])) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="place-category">
                                    <img src="/static/img/Ellipse 859.svg" alt="cate">
                                    <div class="category"><?= htmlspecialchars($category) ?></div>
                                </div>
                            </div>
                            <div class="right">
                                <img src="/static/img/<?= $isSender ? 'Group.svg' : 'up.svg' ?>" alt="zigzag">
                                <div class="right-right">
                                    <div class="summ"><?= $amount ?></div>
                                    <a href="" class="see">See invoice</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- <section class="account-summary">
                <div class="summary"></div>
                <div class="graf-money-info"> 
                    <div class="income"></div>
                    <div class="expense"></div>
                    </div>
                <div class="money-graphic"></div>
            </section> -->

            <img src="/static/img/Account summary.svg" alt="" class="account-summary">

        </section>

    </section>



    <section class="account-menu">
        <div class="menu-content">
            <div class="menu-header">
                <input type="search" placeholder="Search" class="search-input">
                <div class="profile">
                    <img src="/static/img/notification.svg" class="profile__img-1">
                    <img src="/static/img/perfil.svg" class="profile__img-2">
                </div>
            </div>
        </div>
        <div class="menu-wallet">
            <div class="wallet-header">Wallet</div>
            <img src="/static/img/Classic.svg" alt="card">
        </div>

        <div class="menu_quick-transfer">
            <div class="quick-transfer-header">Quick Transfer</div>

            <form class="quick-transfer-form" action="/send.php" method="POST">
                <div class="search-block">
                    <input class="form-phone-number" type="text" placeholder="Account number" name="ReceiverId">
                    <img src="/static/img/button.svg" class="send-button">
                </div>

                <select class="form-card-selector">
                    <option style="color: black;" value="Debit">Debit</option>
                    <option style="color: black;" value="Credit">Credit</option>
                </select>
                <div class="form-amount">
                    <!-- <div class="form-amount-header">Enter amount</div> -->
                    <input class="form-amount-holder" type="number" placeholder="Enter amount" name="Amount">
                </div>
                <input type="hidden" name="SenderId" value="<?= $_id ?>">
                <div class="form-buttons">
                    <button class="send-money-button">Send money</button>
                    <button class="save-button">Save as draft</button>
                </div>


            </form>

        </div>
        <div class="menu_quick-buttons">
            <div class="quick-buttons-send">
                <div class="quick-buttons-block">
                    <img src="/static/img/more.svg">
                    <a href="" class="quick-buttons-send-button">Send</a>
                </div>
                <div class="quick-buttons-block">
                    <img src="/static/img/more.svg">
                    <a href="" class="quick-buttons-receive-button">Receive</a>
                </div>
                <div class="quick-buttons-block">
                    <img src="/static/img/more.svg">
                    <a href="" class="quick-buttons-invoicing-button">Invoicing</a>
                </div>
                <div class="quick-buttons-block">
                    <img src="/static/img/more.svg">
                    <a href="" class="quick-buttons-more-button">More</a>
                </div>

            </div>
        </div>
        <div class="menu-contacts">
            <div class="contacts-header">Contacts</div>
            <img src="/static/img/Contacts.svg">
        </div>
    </section>




</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector(".quick-transfer-form");

        form.addEventListener("submit", async function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch("/send.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json(); // Проверяем JSON

                if (result.success) {
                    location.reload();
                    form.reset();
                } else {
                    alert("Ошибка: " + result.message);
                }
            } catch (error) {
                console.error("Ошибка запроса:", error);
                alert("Произошла ошибка при отправке данных.");
            }
        });
    });


</script>

</html>