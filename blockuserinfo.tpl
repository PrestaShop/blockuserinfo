<div class="user-info">
  {if $logged}
  	<a class="logout"  href="{$link->getPageLink('index', true, NULL, "mylogout")}" rel="nofollow" title="{l s='Log me out' mod='blockuserinfo'}">{l s='Sign out' mod='blockuserinfo'}</a>
    <a class="account" href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' mod='blockuserinfo'}" rel="nofollow"><span>{$customerName}</span></a>
  {else}
  	<a class="login" href="{$link->getPageLink('my-account', true)}" rel="nofollow" title="{l s='Log in to your customer account' mod='blockuserinfo'}">{l s='Sign in' mod='blockuserinfo'}</a>
  {/if}
</div>
