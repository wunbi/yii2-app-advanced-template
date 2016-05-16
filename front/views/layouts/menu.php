<?php
$this->beginContent('@app/views/layouts/base.php');
front\assets\Main1Asset::register($this);

?>

<div class="wrapper">
    <header>
        <label for="AsideChecker"><img src="/image/ui/btn_menu.png" alt="選單" /></label>
        <form class="searchbar" method="get" action="<?=Yii::$app->tool->toBaseUrl(["/announce"]);?>">
            <div class="search"><img src="/image/ui/btn_search.png" alt="搜尋" /></div>
            <div class="input" onclick="<?php echo (Yii::$app->user->isGuest)?"location.href='/user/login'":null; ?>">
                <input type="search" name="keyword" value="<?=Yii::$app->request->getQueryParam("keyword");?>">
            </div>
        </form>
        <div class="home">
            <a href="/"><img src="/image/ui/btn_home.png" alt="回首頁" /></a>
        </div>
    </header>
    <input id="AsideChecker" type="checkbox" />
    <ul class="sidebar">
        <?php if (Yii::$app->user->isGuest): ?>
            <li class="nav_member"><a href="<?= Yii::$app->tool->toBaseUrl(["user/login"]); ?>" title="登入">登入</a></li>
        <?php else: ?>
            <li class="nav_member"><a href="<?= Yii::$app->tool->toBaseUrl(["/user"]); ?>" title="會員資料檢視">會員資料檢視</a></li>
        <?php endif; ?>
        <li class="nav_about"><a href="<?= Yii::$app->tool->toBaseUrl(["/announce"]); ?>" title="關於飢餓三十">關於飢餓三十</a></li>
        <li class="nav_activity"><a href="<?= Yii::$app->tool->toBaseUrl(["/event"]); ?>" title="我的活動">我的活動</a></li>
        <li class="nav_insta"><a href="<?= Yii::$app->tool->toBaseUrl(["site/instagram"]); ?>" title="#飢餓三十">#飢餓三十</a></li>
        <li class="nav_camera"><a href="<?= Yii::$app->tool->toBaseUrl(["/ar"]); ?>" title="飢餓實境相機">飢餓實境相機</a></li>
        <li class="nav_knowledge"><a href="<?= Yii::$app->tool->toBaseUrl(["/knowledge"]); ?>" title="飢餓知識王">飢餓知識王</a></li>
        <li class="nav_donate"><a onclick="open_browser('http://m.worldvision.org.tw/donate_shop.aspx?ID=12')" title="立即捐款">立即捐款</a></li>
        <li class="nav_album"><a href="<?= Yii::$app->tool->toBaseUrl(["/album"]); ?>" title="我的相簿">我的相簿</a></li>
        <li class="nav_logout">
            <?php if (!Yii::$app->user->isGuest): ?><a href="<?= Yii::$app->tool->toBaseUrl(["user/logout"]); ?>" title="登出">登出</a>
            <?php endif; ?>
        </li>

    </ul>

    <?= $content; ?>
</div>

<?php $this->endContent(); ?>