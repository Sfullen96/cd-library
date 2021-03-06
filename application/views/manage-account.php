<h3 class="margin-bottom"> Welcome Back, <?= $accountInfo->username; ?> </h3>
<?php

if(isset($errors)) {
    echo '<div class="alert alert-danger">';
    echo '<ul>';
    echo $errors;
    echo '</ul>';
    echo '</div>';
}

?>

<h5 class="margin-bottom"> Update your details: </h5>

<form action="/user/editAccount" method="POST" role="form" id="registerForm">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="" name="fname" placeholder="First Name" value="<?= (isset($accountInfo->first_name)?$accountInfo->first_name:''); ?>" required >
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="" name="lname" placeholder="Last Name" value="<?= (isset($accountInfo->last_name)?$accountInfo->last_name:''); ?>" required >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="" name="username" placeholder="Username" value="<?= (isset($accountInfo->username)?$accountInfo->username:''); ?>" required >
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="" name="email" placeholder="Email Address" value="<?= (isset($accountInfo->email)?$accountInfo->email:''); ?>" required >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label class="checkbox-inline margin-bottom">
                <input type="checkbox" name="public" <?= ( $accountInfo->public == 1 ? 'checked' : '' ) ?>> Make my profile public?
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"> Save </button>
    <a type="button" href="/profile/<?= $accountInfo->user_id ?>?preview=1" target="_blank" class="pull-right btn btn-primary"> Preview My Profile </a>
</form>