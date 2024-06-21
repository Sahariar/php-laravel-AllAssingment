#!/usr/bin/env php
<?php
class BudgetManager
{
    private $incomeFile;
    private $expenseFile;
    private $categoryFile;
    private $savingFile;
    public function __construct()
    {
        $this->incomeFile = __DIR__ . '/data/income.txt';
        $this->expenseFile = __DIR__ . '/data/expense.txt';
        $this->categoryFile = __DIR__ . '/data/category.txt';
        $this->savingFile = __DIR__ . '/data/saving.txt';
        // Ensure the data directory exists
        if (!is_dir(__DIR__ . '/data')) {
            mkdir(__DIR__ . '/data', 0777, true);
        }
    }

    public function addIncome($income, $category)
    {
        $data = "Income: $income, Category: $category\n";
        $cateData = "Type: Income, Category: $category\n";
        file_put_contents($this->incomeFile, $data, FILE_APPEND);
        file_put_contents($this->categoryFile, $cateData, FILE_APPEND);
        echo "Income of $income added under category $category.\n";
    }
    public function addExpense($expense, $category)
    {
        $data = "Expense: $expense , Category: $category\n";
        $cateData = "Type: Expense, Category: $category\n";
        file_put_contents($this->expenseFile, $data, FILE_APPEND);
        file_put_contents($this->categoryFile, $cateData, FILE_APPEND);
        echo "Expense of $expense added under category $category.\n";
    }
    public function viewIncome()
    {
        if (file_exists($this->incomeFile)) {
            $content = file_get_contents($this->incomeFile);
            if ($content) {
                echo "Listed Income \n";
                echo $content;
            } else {
                echo "No income recorded yet.\n";
            }
        } else {
            echo "Income file does not exist.\n";
        }
    }
    public function viewExpense()
    {
        if (file_exists($this->expenseFile)) {
            $content = file_get_contents($this->expenseFile);
            if ($content) {
                echo "Listed Expense \n";
                echo $content;
            } else {
                echo "No Expense recorded yet.\n";
            }
        } else {
            echo "Expense file does not exist.\n";
        }
    }
    public function viewSaving()
    {
        $totalIncome = $this->calculateTotal($this->incomeFile);
        $totalExpense = $this->calculateTotal($this->expenseFile);
        $saving = $totalIncome - $totalExpense;
        $data = "Total Saving: $saving\n";
        if (file_put_contents($this->savingFile, $data) === false) {
            echo "Failed to save saving.\n";
        } else {
            echo "           Result\n";
            echo "-----------------------------------\n";
            echo "Total Income: $totalIncome\n";
            echo "Total Expense: $totalExpense\n";
            echo "Total Saving: $saving\n";
            echo "-----------------------------------\n";
            echo "Saving calculated and saved.\n";
        }
    }
    private function calculateTotal($file){
        $total = 0.0;
        if(file_exists($file)){
            $content = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach($content as $line){
                if(preg_match('/(Income|Expense): ([\d.]+)/', $line, $matches)){
                    $total += (float)$matches[2];
                }
            }
        }
    return $total;
    }
    public function viewCategory()
    {
        if (file_exists($this->categoryFile)) {
            $content = file_get_contents($this->categoryFile);
            if ($content) {
                echo "Listed Category \n";
                echo $content;
            } else {
                echo "No Category recorded yet.\n";
            }
        } else {
            echo "Category file does not exist.\n";
        }
    }
}

// Function to return an instance of BudgetManager
function budgetManager()
{
    return new BudgetManager();
}

?>