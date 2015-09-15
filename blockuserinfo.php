<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

use PrestaShop\PrestaShop\Core\Business\Module\WidgetInterface;

if (!defined('_PS_VERSION_'))
	exit;

class BlockUserInfo extends Module implements WidgetInterface
{
	public function __construct()
	{
		$this->name = 'blockuserinfo';
		$this->tab = 'front_office_features';
		$this->version = '2.0.0';
		$this->author = 'PrestaShop';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('User info block');
		$this->description = $this->l('Adds a block that displays information about the customer.');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
	}

	public function getWidgetVariables($hookName, array $configuration)
	{
		if (!$this->active)
			return;

		$logged = $this->context->customer->isLogged();
		$customerName = '';
		if ($logged) {
			$customerName = sprintf(
				$this->l('%1$s %2$s'),
				$this->context->customer->firstname,
				$this->context->customer->lastname
			);
		}

		$link = $this->context->link;

		return [
			'logged' 			=> $logged,
			'customerName' 		=> $customerName,
			'logout_url'		=> $link->getPageLink('index', true, NULL, 'mylogout'),
			'my_account_url'	=> $link->getPageLink('my-account', true),

		];
	}

	public function renderWidget($hookName, array $configuration)
	{
		$this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
		return $this->display(__FILE__, 'blockuserinfo.tpl');
	}
}
