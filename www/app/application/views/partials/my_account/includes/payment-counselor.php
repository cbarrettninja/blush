<% if(app.user.user_type_id == app.user_type_counselor) { %>
<p>In order to receive payments from Blush, you must have a valid checking account on-file with our system.  To add or update your bank account, use the form below.</p>

<?
$stripe_recipient = "";
$valid_customer = false;
if (isset($user->stripe_customer_id) && $user->stripe_customer_id) {
    $stripe_recipient = get_stripe_recipient();
}

if($stripe_recipient && !$stripe_recipient['deleted'] && $stripe_recipient['active_account']) {
    $account = json_decode($stripe_recipient['active_account']);
    if($account) {
        $valid_customer = true;
    }
?>

    <div class="existing-card">
        <p>The following account is on-file as the account that we will use to send payments. If you would like to change it, please use the form below.</p>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bank</label>
                    <p><?=$account->bank_name?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Last 4 Digits of Account</label>
                    <p><?=$account->last4?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="btn btn-sm btn-pink card-fields-toggle">Change Account</a>
            </div>
        </div>
    </div>
<? } ?>
<div class="card-fields"  <? if ($valid_customer) {?>style="display:none"<? } ?>>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="sr-only" for="business-name">Business Name</label>
                <input type="text" class="form-control stripe-sensitive business-name" id="business-name"
                       placeholder="Business Name" tabindex="1" <? if (!isset($user->stripe_customer_id) || !$user->stripe_customer_id) {?>data-rule-required="true"<? } ?> name="business_name">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="sr-only" for="account-number">Account Number</label>
                <input type="text" class="form-control stripe-sensitive account-number" id="account-number"
                       placeholder="Account Number" tabindex="2" <? if (!$valid_customer) {?>data-rule-required="true"<? } ?>>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="sr-only" for="routing-number">Routing Number</label>
                <input type="text" class="form-control stripe-sensitive routing-number" id="routing-number"
                       placeholder="Routing Number" tabindex="3" <? if (!$valid_customer) {?>data-rule-required="true"<? } ?>>
            </div>
        </div>
    </div>
</div>
<% } %>