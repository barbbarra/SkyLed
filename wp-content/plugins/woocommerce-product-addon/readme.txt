=== WooCommerce Product Addons ===
Contributors: nmedia
Tags: woocommerce, pesonalized products, variations, woocommerce extra fields, woocommerce extra options, woocommerce personalized product, woocommerce t-shirt design, woocommerce product fields
Donate link: http://www.najeebmedia.com/donate
Requires at least: 3.5
Tested up to: 4.9
Stable tag: 11.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

WooCommerce PPOM (Personalized Product Option Manager) Plugin adds input fields on product page to personalized your product.
Client can provide information about his order on product page with the help of these PPOM fields. PPOM has more than 20 types of inputs.
In basic version we have added 5 basic input.

= Version 4.0 =
Since version 4.0 PPOM basic version will be used as core plugin and PRO will be distributed as separated plugin. 

= Features =
* Five type inputs
* Text
* Textarea
* Select
* Radio
* Checkbox
* Conditional logic
* Field attached to order and email

= Surprise Discount Upto 25% =
* Please install this plugin to see your Coupon Code.

= How it works (Pro Version) =
[vimeo https://vimeo.com/85584591]

= Demo = 
[Click here](http://najeebmedia.com/wordpress-plugin/woocommerce-personalized-product-option/)

= PPOM Fields Demo = 
[Click here](https://najeebmedia.com/2018/01/02/woocommerce-personalized-product-options-manager-inputs-guide/)

= Pro Features =
* 20 Types Input
* Field level validation message control
* Dynamic Prices (Select | Checkbox | Radio)
* Show Thumb on Cart Page of Uploaded Image
* Image Cropping
* Large image upload with Chunk feature
* Fully Responsive
* Remove images| Order not completed
* Fixed and Discount Price
* Thumbs Preview
* Conditional Fields

[See All Features](http://najeebmedia.com/wordpress-plugin/woocommerce-personalized-product-option/)

== Installation ==
1. Upload plugin directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. After activation, you can set options from `WooCommerce -> PPOM Settings` menu

== Screenshots ==

1. Plugin options (input fields)
2. Selecting meta with product	
3. Showing inputs on front end product
4. Inputs attached to cart item
5. Inputs attached to checkout page
6. Inputs attached with order invoice
7. Finally admin can see all attached inputs in orders panel
8. After Order is paid in my account
9. Attach inputs to bulk products

== Changelog ==
= 11.3 April 3, 2018 =
Adjustment: [+ symbol is removed from option price](https://clients.najeebmedia.com/forums/topic/options-with-price-30-show-as-30/)
Bug fixed: [WooCommerce hooks warning removed due to inconsistent parameters call](https://wordpress.org/support/topic/cannot-finish-order/)
= 11.2 March 27, 2018 =
* Bug fixed: [Quantities input does not update prices when used in conditions, it's fixed now.](https://clients.najeebmedia.com/forums/topic/need-help-in-quantity-and-sizes-and-color-not-working/#post-8584)
* Bug fixed: [A warning message is removed from script](https://wordpress.org/support/topic/upgrade-problems-from-3-6-to-10-7/)
= 11.1 March 25, 2018 =
* Feature: [lightbox class added in cart image thumbs](https://wordpress.org/support/topic/support-1-wordpress-theme-divi-lightbox/)
* Bug fixed: [WPML deprecated function replaced with new filter](https://wordpress.org/support/topic/compatibility-with-polylang-6/)
* Bug fixed: WPML compatibility issue fixed with new filter ppom_use_parent_product_ml
= 11.0 March 15, 2018 =
* Feature: Options are not sortable for select,radio and checkbox.
* Bug fixed: WPML compatibility checked again for bug and fixed.
= 10.10 March 8, 2018 =
* Feature: Selected images now show in table with label
* Bug fixed: Image type input issue when multiple images selected only one show
* Bug fixed: Files and Cropped images has issue when order multiple with same product.
* Bug fixed: Conditional login rest the selected options for checkbox,radio and select. Now they will set again when re-appear.
* Bug fixed: [Cropped image deleted issue fixed](https://clients.najeebmedia.com/forums/topic/deleting-images-with-croppie/)
* Bug fixed: [WC variation prices not updated when hidden](https://wordpress.org/support/topic/bug-in-price-display-with-product-with-multiple-variations/)
* Bug fixed: [Do not show Select option when out of stock](https://wordpress.org/support/topic/archieve-button-shows-select-options/#post-10038761)
= 10.9 March 1, 2018 =
* Bug fixed: Image type input were not attached in orders
* Adjustment: meta data is now sent to cart and order with new approach
* Bug fixed: Ajax validation issue fixed
= 10.8 February 25, 2018 =
* Feature: Disable past date feature added in datepicker input.
* Feature: Disable Weekends feature added in datepicker input.
* Feature: Compatibility added with currency swithcer plugin
* Bug fixed: Some errors removed in email
= 10.7 February 21, 2018 =
* Feature: Ajax based validation is back now
* Bug fixed: Text/Number max/min validation were not working
* Bug fixed: Meta fields were cutting/hiding in mobile.
* Bug fixed: Bug fixed in ppom_add_thousand_seperator function when thousand seprator is not defined
* Bug fixed: Tax calculation issue fixed on cart page.
= 10.6 February 13, 2018 =
* [version number is now sync with pro version]
* Bug fixed: Images edited with Aivary were not showing. It's fixed now.
* Bug fixed: Uploaded images were not showing in new WC version. It's fixed now.
* Bug fixed: Cropped images were not showing in new WC version. It's fixed now.
= 4.5 February 10, 2018 =
* Bug fixed: Now Fixed fee lables are prefix with no
* Adjustment: Variable product show price are not correct with PPOM option price, we have hide this.
= 4.4 February 8, 2018 =
* Feature: Fixed fee taxable will now show on product page.
* Bug fixed: IE 11 issue fixed
* Bug fixed: Meta import issue fixed
* Bug fixed: When dynamic_price_display is set to hide, prices were not adding.
* Bug fixed: Conditional field display for image type is fixed for single select
= 4.3 February 2, 2018 =
* Feature: "Please enter" placeholder removed from text input
* Feature: Radio and Checkbox now has 5px margin to left between lable and input
* Feature: PDF Invoice and Printing Slip plugin compatibility added
= 4.2 February 1, 2018 =
* Bug fixed: Fixed fee were not added if first item in cart has not fixed fee
* Feature: Filter added to change fixed fee label `ppom_fixed_fee_label`
= 4.1 January 30, 2018 =
* Bug fixed: Changes were not saving in admin when update from old version.
= 4.0 January 26, 2018 =
* Now Core Plugin is pushed on WordPress
* New UI
* Bootrap based fields
* Feature: Export selected meta groups
* Revised coding
= 3.6 November 27, 2017 =
* Bug fixed: Existing Metas were not showing, now it's fixed
= 3.5 November 13, 2017 =
* Bug fixed: [Conflict removed with Quick View Plugin](https://wordpress.org/support/topic/this-plugin-conflicts-with-quick-view-plugins/)
= 3.4 November 4, 2017 =
* Bug fixed: [Warning removed when using Textarea](https://wordpress.org/support/topic/textarea-error-notice-undefined-index-min_length/)
* Filter Added: [Filter added to change select option label](https://wordpress.org/support/topic/product-button-text/)
= 3.3 June 5, 2017 =
* Bug fixed: Slashes issue fixed in title. Like (It's a lable) can be used
= 3.2 June 1, 2017 =
* Bug fixed: [Delete meta was not working, it's fixed](https://wordpress.org/support/topic/works-well-but-theres-a-quirk/)
= 3.1 May 22, 2017 =
* Features Added: Old versions compatibility added.
* Features Added: Better UI for Export/Import Meta
= 3.0 May 13, 2017 =
* Bug fixed: validation issue fixed by addin esc_url, esc_attr functions
* Bug fixed: Script properly enqueu for validation checking
* Bug fixed: Couple of functions renamed
= 2.9 May 8, 2017 =
* Bug fixed: [404 Error fixed for plupload library](https://wordpress.org/support/topic/failed-to-load-resource-error-message/)
= 2.8 April 16, 2017 =
* WooCommerce 3.0 Update Checked and removed deprecated functions.
= 2.7 March 8, 2017 =
* Bug fixed: Removed 0.0 if priced is not set with radio input. (select and checkbox already fixed)
= 2.6 February 3, 2017 =
* Bug fixed: Security related issue fixed.
* Bug fixed: for Percentage label was not correct foc checkbox.
= 2.5 January 5, 2016 =
* Coupon Updated for Discount 25% on PRO version.
= 2.4 November 29, 2016 =
* Bug fix: Some security related issues removed, please update
= 2.3 November 20, 2016 =
* Some changes requested by WP team
* Bug fixed: Checkbox options now show as value, not ARRAY
= 2.2 August 2, 2016 =
* Critical bug fixed, please update
= 2.1 August 2, 2016 =
* Quick bug fixed for API
= 2.0 August 2, 2016 =
* New field checkbox added
* Fixed variable price issue
* Show lazyloader when options being added to cart
* Some bug fixed

= 1.1 March 17, 2016 =
* conflict removed with Checkout Editor plugin
* Compatibility checked for WC new version

= 1.0 24/4/2015 =
* Plugin just released