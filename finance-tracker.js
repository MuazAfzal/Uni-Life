document.getElementById('financeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get the values from the form
    const income = parseFloat(document.getElementById('income').value);
    const rent = parseFloat(document.getElementById('rent').value);

    if (isNaN(income) || isNaN(rent) || income <= 0 || rent < 0) {
        alert('Please enter valid values for income and rent.');
        return;
    }

    // Calculate the remaining income after rent
    const remainingIncome = income - rent;

    // Calculate budgets for different categories based on remaining income
    const foodBudget = remainingIncome * 0.30; // 30% for food
    const transportBudget = remainingIncome * 0.15; // 15% for transport
    const entertainmentBudget = remainingIncome * 0.10; // 10% for entertainment
    const savingsBudget = remainingIncome * 0.65; // 65% for savings (food + transport + entertainment + miscellaneous)

    // Display the results
    document.getElementById('remainingIncome').textContent = `£${remainingIncome.toFixed(2)}`;
    document.getElementById('foodBudget').textContent = `£${foodBudget.toFixed(2)}`;
    document.getElementById('transportBudget').textContent = `£${transportBudget.toFixed(2)}`;
    document.getElementById('entertainmentBudget').textContent = `£${entertainmentBudget.toFixed(2)}`;
    document.getElementById('savingsBudget').textContent = `£${savingsBudget.toFixed(2)}`;

    // Show the result section
    document.getElementById('result').style.display = 'block';
});
