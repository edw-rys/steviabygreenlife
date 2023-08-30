<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart() {
        $response = '
        {
            "uid": "1c04bf82-3162-438d-ab51-4d7981d50283",
            "data": {
                "order": {
                    "no": 0,
                    "funnelStepVariantId": 0,
                    "additionalFields": null,
                    "discount": null,
                    "subTotal": 5.33,
                    "shippingCountries": [
                        "EC"
                    ],
                    "preShippingTaxes": [],
                    "isSampleOrder": false,
                    "paymentType": "paypal",
                    "total": 5.33,
                    "funnelId": 0,
                    "shipping": {
                        "countryCode": "EC",
                        "order": 1,
                        "name": "Envio Guayaquil y Quito",
                        "type": 0,
                        "rangeFrom": 0.0,
                        "rangeTo": null,
                        "cost": 0.0,
                        "kind": "system",
                        "extra": null,
                        "calculated": true,
                        "external": false
                    },
                    "shippingInfoRequired": true,
                    "customerEmail": "edw-toni@hotmail.com",
                    "extra": null,
                    "id": 168,
                    "shippingOptions": [
                        {
                            "countryCode": "EC",
                            "order": 1,
                            "name": "Envio Guayaquil y Quito",
                            "type": 0,
                            "rangeFrom": 0.0,
                            "rangeTo": null,
                            "cost": 0.0,
                            "kind": "system",
                            "extra": null,
                            "calculated": true,
                            "external": false
                        }
                    ],
                    "subTotalNoDiscount": 5.33,
                    "contactId": 11,
                    "created": "08\/08\/2023 10:23 AM",
                    "hasShipping": true,
                    "weight": 0.05,
                    "loginRequired": false,
                    "funnelStepId": 0,
                    "customerName": "edw",
                    "transactionId": "",
                    "clientSessionId": "cart",
                    "size": 1,
                    "postShippingTaxes": [],
                    "meta": {
                        "mailchimpLists": null,
                        "getresponseLists": null,
                        "activecampaignLists": null,
                        "mailerliteLists": null,
                        "moosendLists": null,
                        "aweberLists": null,
                        "keapLists": null,
                        "marketingLists": null,
                        "tags": null,
                        "autoresponderFields": null,
                        "courier": null,
                        "trackingNo": null,
                        "trackingUrl": null,
                        "doubleOptIn": false,
                        "collectedFromCustomer": null,
                        "notes": null,
                        "renewal": false,
                        "extra": null
                    },
                    "paid": false,
                    "shippingAddress": {
                        "name": "",
                        "phone": "",
                        "companyName": "",
                        "companyId": "",
                        "vatId": "",
                        "country": "EC",
                        "state": "Guayas",
                        "city": "Guayaquil",
                        "zipCode": "091003",
                        "address": "Cerecita",
                        "address2": ""
                    },
                    "attributes": {},
                    "billingAddress": {
                        "name": "",
                        "phone": "",
                        "companyName": "",
                        "companyId": "",
                        "vatId": "",
                        "country": "EC",
                        "state": "Guayas",
                        "city": "Guayaquil",
                        "zipCode": "091003",
                        "address": "Cerecita",
                        "address2": ""
                    },
                    "collectedFromCustomer": null,
                    "items": [
                        {
                            "images": [
                                {
                                    "name": "Productos_Tienda/DSC08429-3218830.png",
                                    "base": "s/73296972938990007/"
                                },
                                {
                                    "name": "Productos_Tienda/stevia_powder-05-3119865.png",
                                    "base": "s/73296972938990007/"
                                }
                            ],
                            "quantityAvailable": true,
                            "quantity": 1,
                            "productId": 3,
                            "additions": [],
                            "saleType": "REGULAR",
                            "weight": 0.05,
                            "productWithVariations": false,
                            "subscription": null,
                            "title": "Stevia Powder 50 sobres",
                            "type": "PHYSICAL",
                            "variation": [],
                            "url": "stevia-powder50sobres",
                            "token": null,
                            "isSubscription": false,
                            "price": 5.33,
                            "bump": false,
                            "onSale": true,
                            "id": 214,
                            "sku": "",
                            "combination": -1,
                            "basePrice": 5.92
                        }
                    ],
                    "discountValue": 0,
                    "status": "ABANDONED"
                }
            },
            "success": true,
            "ok": true
        }
        ';
        return response()->json(
            json_decode($response)
        );
    }

    public function show() {
        return view('front.pages.cart');
    }
}
