<?php
class DashboardController extends Controller
{
  private $pizzaModel;

  public function __construct()
  {
    $this->pizzaModel = $this->model('PizzaModel');
  }

  public function index($pageNumber = NULL)
  {
    // Get all available ingredients
    $ingredients = $this->pizzaModel->getAllIngredients();

    // Check if ingredients are selected
    if (isset($_POST['selectedIngredients'])) {
      $selectedIngredients = $_POST['selectedIngredients'];

      $totalRecords = count($this->pizzaModel->getPizzasByIngredients($selectedIngredients));
      $pagination = $this->pagination($pageNumber, 4, $totalRecords);

      $pizzas = $this->pizzaModel->getPizzasByIngredientsAndPage($selectedIngredients, $pagination['offset'], $pagination['recordsPerPage']);
    } else {
      $totalRecords = count($this->pizzaModel->getActivePizzas());
      $pagination = $this->pagination($pageNumber, 6, $totalRecords);

      $pizzas = $this->pizzaModel->getPizzasByPage($pagination['offset'], $pagination['recordsPerPage']);
    }

    $data = [
      'Pizzas' => $pizzas,
      'Ingredients' => $ingredients,
      'pageNumber' => $pagination['pageNumber'],
      'nextPage' => $pagination['nextPage'],
      'previousPage' => $pagination['previousPage'],
      'totalPages' => $pagination['totalPages'],
      'firstPage' => $pagination['firstPage'],
      'secondPage' => $pagination['secondPage'],
      'thirdPage' => $pagination['thirdPage'],
      'offset' => $pagination['offset'],
      'recordsPerPage' => $pagination['recordsPerPage']
    ];
    $this->view('homepages/index', $data);
  }
}
