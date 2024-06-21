#!/usr/bin/env php
<?php 
    //Include the budgetManager.php file
    require_once 'budgetManager.php';

    function welcomeMenu(){
        echo"1. Add income \n";
        echo"2. Add expense \n";
        echo"3. View incomes \n";
        echo"4. View expenses \n";
        echo"5. View savings \n";
        echo"6. View categories \n";
        echo"7. exit \n";
        echo "Enter your choice: \n";
    }

    function userInput($choice){
        switch($choice){
            case 1;
            $income =(float)trim(readline("Enter Earning Amount: "));
            $category = trim(readline("Enter Income Category: "));
            echo "-----------------------------------\n";
            budgetManager()->addIncome($income,$category );
            echo "-----------------------------------\n";
            break;
            case 2;
            $expense =(float)trim(readline("Enter Expense Amount: "));
            $category = trim(readline("Enter Expense Category: "));
            echo "-----------------------------------\n";
            budgetManager()->addExpense($expense , $category);
            echo "-----------------------------------\n";
            break;
            case 3;
            echo "-----------------------------------\n";
            budgetManager()->viewIncome();
            echo "-----------------------------------\n";
            break;
            case 4;
            echo "-----------------------------------\n";
            budgetManager()->viewExpense();
            echo "-----------------------------------\n";
            break;
            case 5;
            echo "-----------------------------------\n";
            budgetManager()->viewSaving();
            echo "-----------------------------------\n";
            break;
            case 6;
            echo "-----------------------------------\n";
            budgetManager()->viewCategory();
            echo "-----------------------------------\n";
            exit;
            default;
            echo "-----------------------------------\n";
            echo"wrong Input \n";
            echo "-----------------------------------\n";
        }
    }
    while(true){
        welcomeMenu();
        $choice = trim(fgets(STDIN));
        userInput($choice);
    }
?>