<?php
class CartController extends Controller
{
    // private $pizzaModel;

    public function __construct()
    {
        // $this->pizzaModel = $this->model('PizzaModel');
    }

    public function index()
    {
        $this->view('carts/index');
    }
}
