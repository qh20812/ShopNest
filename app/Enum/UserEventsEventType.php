<?php

namespace App\Enums;

enum UserEventsEventType: string
{
    case PAGE_VIEW = 'page_view';
    case PRODUCT_VIEW = 'product_view';
    case ADD_TO_CART = 'add_to_cart';
    case REMOVE_FROM_CART = 'remove_from_cart';
    case CHECKOUT_START = 'checkout_start';
    case CHECKOUT_COMPLETE = 'checkout_complete';
    case PURCHASE = 'purchase';
    case LOGIN = 'login';
    case REGISTER = 'register';
    case LOGOUT = 'logout';
    case SEARCH = 'search';
    case FILTER = 'filter';
    case WISHLIST_ADD = 'wishlist_add';
}