<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\CmsHelper;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show a page with CMS content support.
     *
     * @param string $slug
     * @param string $defaultTitle
     * @param string $view
     * @return \Illuminate\View\View
     */
    protected function showPage($slug, $defaultTitle, $view)
    {
        $page = CmsHelper::getPage($slug, [
            'title' => $defaultTitle,
        ]);

        return view($view, compact('page', 'slug'));
    }

    /**
     * Show the terms and conditions page.
     */
    public function terms()
    {
        return $this->showPage('terms', 'Terms & Conditions', 'frontend.pages.terms');
    }

    /**
     * Show the privacy policy page.
     */
    public function privacy()
    {
        return $this->showPage('privacy', 'Privacy Policy', 'frontend.pages.privacy');
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        return $this->showPage('about', 'About Us', 'frontend.pages.about');
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return $this->showPage('contact', 'Contact Us', 'frontend.pages.contact');
    }

    /**
     * Show the refund policy page.
     */
    public function refundPolicy()
    {
        return $this->showPage('refund-policy', 'Refund Policy', 'frontend.pages.refund-policy');
    }

    /**
     * Show the shipping policy page.
     */
    public function shippingPolicy()
    {
        return $this->showPage('shipping-policy', 'Shipping Policy', 'frontend.pages.shipping-policy');
    }
}
