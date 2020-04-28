=== MakeCommerce for WooCommerce ===
Contributors: makecommerce
Tags: woocommerce, payment, maksekeskus, shipping, banklink, creditcard, estonia, latvia, lithuania, pangalink, kaardimaksed, omniva, smartPOST, WPML , eesti, swedbank, seb, lhv, citadele, nordea, pocopay
Requires at least: 4.0
Tested up to: 5.0.1
Stable tag: 2.5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Payment Gateway for Estonian, Latvian, Lithuanian and Finnish bank-links and Visa/MasterCard payments with single contract (by Maksekeskus). And more...


== Description ==
This plugin allows you accept online payments using the MakeCommerce/Maksekeskus Payment Gateway.
In order to use the services you need to sign up at https://makecommerce.net/
and then configure the module by entering API credentials given to your shop after sign-up.
(you can also test out the module without signup, using test-shop credentials).

The plugin offers bank-links of all major banks in Estonian, Latvian, Lithuanian and Finnish markets, plus credit card payments.
You only need to have one bank account, no need to sign contracts with multiple different banks.
We have no contract or sign-up fees. Traditional banks charge contract fees that will make your initial costs much higher.
See more: https://makecommerce.net/en/prices/
Plus it solves some shipments-related functions as well.

Overview of functionality:

* bank-links of all major banks in Estonia, Latvia, Lithuania, Finland
* credit-card payments (Visa, Mastercard) through MakeCommerce PCI DSS compliant card dialog (removes compliancy requirement from merchant)
* customisable payment methods presentation  
* payment country selector independent from billing/shipping address
* make full or partial refunds right within shop Admin (order view)
* omniva.ee & smartpost.ee automated parcel terminals as shipment methods
* omniva.ee courier service as shipment method
* automatic registration of shipments into omniva.ee & smartpost.ee systems
* printing omniva/smartpost parcel labels right within shop Admin (orders view)
* shipping methods support Shipping Zones
* supports multi-lingual shops (WPML-based)
* supports WordPress multi-site



== Installation ==

1. install the plugin through the WordPress plugins screen directly.
2. activate the plugin through the 'Plugins' screen in WordPress
3. configure MakeCommerce API settings (Woocommerce->API->MakeCommerce API access)
4. fine-tune and activate your payment settings (Woocommerce->Checkout->MakeCommerce)
5. configure and activate shipping methods:
  * Woocommerce->Shipping->Omniva Parcel Machine by MC 
  * Woocommerce->Shipping->SmartPOST Parcel Machine by MC
  * Woocommerce->Shipping->Omniva Courier by MC
  * Woocommerce->Shipping->SmartPOST Courier by MC


See more on:
https://makecommerce.net/en/integration-modules/MakeCommerce-WooCommerce-Payment-plugin/


== Screenshots ==

1. presentation of payment methods in checkout dialog
5. easy way to refund 
10. the plugin adds to shipping methods to the shop
11. the plugin provides dropdowns of Parcel Terminals to checkout page
14. you can print package labels right from the shop admin view
15. you can mark some product as 'not suitable' for parcel terminal delivery
21. for multi-lingual shops you can adjust translations 


-

== Changelog ==
= 2.5.5 2019-10-23
* Fix - mTasku and Pay Later methods support added

= 2.5.4 2019-06-14 =
* Fix - PolyLang / WPML detection further improved *

= 2.5.3 2019-06-13 =
* Fix - Changed PolyLang detection, previous one broke WPML *

= 2.5.2 2019-04-03 =
* Fix - Omniva tracking code was erraneously replaced on order update

= 2.5.1 2019-02-03 =
* Fix - WPML handling improved, return pages / confirmation emails now in previously selected language

= 2.5.0 2018-12-18 =
* Fix - Shipping tax calculation fix

= 2.4.9 2018-09-18 =
* Fix - Pre/post WC 3.4 handling improved

= 2.4.8 2018-09-17 =
* Fix - Initial configuration links fixed, typo fix

= 2.4.7 2018-09-17 =
* Fix - Initial configuration links fixed

= 2.4.6 2018-06-15 =
* Fix - Mobile number check without area code

= 2.4.5 2018-05-20 =
* Fix - Finnish Nordea logo

= 2.4.4 2018-05-20 =
* Fix - Woocommerce 3.4.X support

= 2.4.3 2018-02-09 =
* Fix - Woocommerce 3.3.x support
* Fix - compatibility with BackupBuddy plugin
* Tweak - Enabled the "enabled" button
* Feature - Simple Checkout enabled by default

= 2.4.2 2017-10-24 =
* Fix - Woocommerce 2.6.x support
* Fix - php errors fixed
* Tweak - Coupon usage for free transportation
* Feature - Ability to change order shipping information in Admin view

= 2.4.1 2017-08-30 =
* Tweak - Disabled autoload of "Shipping destinations"

= 2.4 2017-07-12 =
* Feature - added support for Woocommerce Subscriptions recurring payments (https://woocommerce.com/products/woocommerce-subscriptions/
* Fix - 'Print Parcel labels' button did not work in some cases

= 2.3.1 2017-07-03 =
* Fix - fixing backward support for older Woo version
* Tweak - on payment, removed order state valuation, Woo handles it

= 2.3 2017-05-25 =
* Feature - Omniva Parcel Terminals can be used without Omniva contract (paid via Maksekeskus)
* Feature - Added transport method 'DPD pickup network'
* Feature - SmartPOST courier now supports delivery time-window selection
* Feature - SimpleCheckout now supports Woo coupons

= 2.2.7 2017-05-09 =
* Fix - SimpleCheckout now supports product variations

= 2.2.6 2017-05-03 =
* Tweak - SimpleCheckout now respects 'Enable Guest Checkout' setting
* Fix - SimpleCheckout does not include disabled shipping methods
* Fix - another Woo 2.6 - 3.0 compatibility fixes

= 2.2.5 2017-04-27 =
* Fix - another Woo 2.6 - 3.0 compatibility fix

= 2.2.4 2017-04-25 =
* Fix - fixed SimpleCheckout compatibility with Woo 3.0 warnings
* Fix - shipping method tax calculation fix on Simplecheckout

= 2.2.3 2017-04-18 =
* Fix - tax was not correctly applied on SimpleCheckout

= 2.2.2 2017-04-10 =
* Fix - wrong country selector (flag) was not high-lighted at payment method selection on Woo 3.x

= 2.2.1 2017-04-03 =
* Feature - Support for WordPress Multi-Site, aka WPMU, aka Network
* Fix - SimpleCheckout to work without any shipping methods

= 2.2.0 2017-03-21 =
* Feature - SimpleCheckout
* Tweak - translations of error texts
* Tweak - individual sub-modules can be switched on/off on API settings page
* Fix - making refund now works again

= 2.1.5 2017-02-20 =
* Fix - parcel label print resulted in empty page

= 2.1.4 2017-02-17 =
* Fix - parcel-machine related shipping methods were not available at some cases

= 2.1.3 2017-02-17 =
* Feature - new Shipping method - SmartPOST courier
* Tweak - parcel terminal name/address is now copied into order delivery address
* Fix - canceling payment process will now return to cart
* Fix - fixed some warning messages popping up

= 2.1.2 2017-01-30 =
* Fix - occasional false warning 'No payment methods for selected country' removed
* Fix - parcel-machine info was missing from order view

= 2.1.1 2017-01-17 =
* Fix - when shop had credit-card only from MK, the card logos were not displayed
* Tweak - fallback to billing address data when registering shipment at carrier and shipment address field is empty 
* Tweak - credit-card dialog now loaded on /order-pay/ page
* Tweak - various translations improvements
* Tweak - code restructured and cleaned

= 2.0.1 2016-11-29 =
* Tweak - product parcel-machine shipment attributes available now for variable product type as well
* Tweak - removed 'shipped via' hook

= 2.0.0 2016-11-24 =
* Feature - Shipping methods now use Woocommerce Shipping Zones, you can define pricing per zone
* Feature - added shipping method "Omniva courier"
* Feature - possibility to hide country selector (flag) at payment methods
* Tweak - shop configuration is updated automatically, daily
* Tweak - solved a conflict with polylang (though not compatible with)
* Fix - improved language handling on card-payment (wpml)
* Fix - improved translations handling of shipping methods (wpml)
* Tweak - improved priority grouping in parcel terminals listing
* Tweak - display weight units at shipment method configurations

= 1.1.7 2016-09-19 =
* Feature - Omniva/Itella shipping methods: added possibility to define free shipping amount per destination country
* Feature - added 'Print parcel label' button to order view
* Feature - added possibility to mark a product as "Shipping free to parcel automat"
* Tweak - simplified payment methods settings dialog (shop name comes from API)
* Tweak - simplified API settings dialog
* Tweak - improved payment options presentation 

= 1.1.5 2016-08-15 =
* Fix - Fixed mising sender data on parcel label print

= 1.1.4 2016-08-15 =
* Fix - Parcel Machine selection verification did not work on some themes

= 1.1.3 2016-08-09 =
* Fix - got rid of waring on order confirmation page 

= 1.1.2 2016-08-04 =
* Fix - fixed Parcel Machine selection bug 

= 1.1.1 2016-07-27 =
* Tweak - improved Parcel Machine dropdown presenation 
* Tweak - added ru and fi transaltion files

= 1.1 2016-07-27 =
* Fix - parcel machine dropdown did not appear if only one shipment method was enabled
* Feature - WPML-based multilingual shop support

= 0.5 =
* initial release


== Upgrade Notice ==
Upgrade to version 2.0.0 requires WooCommerce 2.6 as minimum (because of the Shipping Zones)
https://docs.woocommerce.com/document/setting-up-shipping-zones/

Upgrade to 2.0.0 will create shipping zones based on your current configuration,
will enable the shipping methods in respective zones and will current transfer pricing to those zones.
Please review your shipment zones and setup after the upgrade.









