<?php
class PizzaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getActivePizzas(): array
    {
        try {
            $getPizzasQuery = "SELECT pizzaId, pizzaName, pizzaImage, pizzaPrice, pizzaDescription 
                        FROM `pizzas`
                        WHERE pizzaIsActive = 1";

            $this->db->query($getPizzasQuery);

            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get active pizzas from the database in class PizzaModel.");
            die('Error: Failed to get active pizzas');
        }
    }

    public function getAllIngredients(): array
    {
        try {
            $getIngredientsQuery = "SELECT ingredientId, ingredientName 
                                    FROM `ingredients`
                                    WHERE ingredientIsActive = 1";
            $this->db->query($getIngredientsQuery);
            $result = $this->db->resultSet();
            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get active ingredients from the database in class PizzaModel.");
            die('Error: Failed to get active ingredients');
        }
    }

    public function getPizzasByIngredients(array $selectedIngredients): array
    {
        try {
            $selectedIngredientsStr = implode(',', $selectedIngredients);
            $getPizzasQuery = "SELECT DISTINCT p.pizzaId, p.pizzaName, p.pizzaImage, p.pizzaPrice, p.pizzaDescription
                                FROM `pizzas` p
                                JOIN `pizzahasingredients` pi ON p.pizzaId = pi.pizzaId
                                WHERE p.pizzaIsActive = 1
                                AND pi.ingredientId IN ($selectedIngredientsStr)";

            $this->db->query($getPizzasQuery);
            $result = $this->db->resultSet();
            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get pizzas by ingredients from the database in class PizzaModel.");
            die('Error: Failed to get pizzas by ingredients');
        }
    }

    public function getPizzasByPage($offset, $itemsPerPage): array
    {
        try {
            $getPizzasQuery = "SELECT pizzaId, pizzaName, pizzaImage, pizzaPrice, pizzaDescription
                        FROM `pizzas`
                        WHERE pizzaIsActive = 1
                        LIMIT $offset, $itemsPerPage";

            $this->db->query($getPizzasQuery);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get paginated pizzas from the database in class PizzaModel.");
            die('Error: Failed to get paginated pizzas');
        }
    }

    public function getPizzasByIngredientsAndPage($selectedIngredients, $offset, $itemsPerPage): array
    {
        try {
            $selectedIngredientsStr = implode(',', $selectedIngredients);
            $getPizzasQuery = "SELECT p.pizzaId, p.pizzaName, p.pizzaImage, p.pizzaPrice, p.pizzaDescription
                        FROM `pizzas` as p
                        JOIN `pizzahasingredients` pi ON p.pizzaId = pi.pizzaId
                        WHERE pizzaIsActive = 1
                        AND pi.ingredientId IN ($selectedIngredientsStr)
                        LIMIT $offset, $itemsPerPage";

            $this->db->query($getPizzasQuery);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get paginated pizzas from the database in class PizzaModel.");
            die('Error: Failed to get paginated pizzas');
        }
    }
}
