let allRecipes = [];

// Fetch recipes from the backend API
fetch("api/recipe.php")
  .then((res) => res.json())
  .then((data) => {
    allRecipes = data;
  });

// Main app initialization
document.addEventListener("DOMContentLoaded", () => {
  // Selected ingredients management
  const selectedIngredients = new Set();
  const ingredientButtons = document.querySelectorAll(".ingredient-btn");
  const selectedIngredientsContainer = document.getElementById(
    "selectedIngredients"
  );
  const findRecipesBtn = document.getElementById("findRecipes");

  function updateSelectedIngredients() {
    selectedIngredientsContainer.innerHTML = "";
    selectedIngredients.forEach((ingredient) => {
      const chip = document.createElement("span");
      chip.className = "selected-ingredient";
      chip.innerHTML = `
                ${ingredient}
                <button onclick="removeIngredient('${ingredient}')">×</button>
            `;
      selectedIngredientsContainer.appendChild(chip);
    });

    // Update find recipes button state
    findRecipesBtn.disabled = selectedIngredients.size === 0;
  }

  window.removeIngredient = (ingredient) => {
    selectedIngredients.delete(ingredient);
    const button = document.querySelector(`[data-ingredient="${ingredient}"]`);
    if (button) button.classList.remove("selected");
    updateSelectedIngredients();
  };

  ingredientButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const ingredient = button.dataset.ingredient;
      if (button.classList.contains("selected")) {
        selectedIngredients.delete(ingredient);
        button.classList.remove("selected");
      } else {
        selectedIngredients.add(ingredient);
        button.classList.add("selected");
      }
      updateSelectedIngredients();
    });
  });

  // View management
  const views = {
    ingredientSelector: document.getElementById("ingredientSelector"),
    popularRecipes: document.getElementById("popularRecipes"),
    recipeResults: document.getElementById("recipeResults"),
    recipeDetails: document.getElementById("recipeDetails"),
    aboutView: document.getElementById("aboutView"),
  };

  function showView(viewName) {
    // Update view visibility
    Object.entries(views).forEach(([name, element]) => {
      element.style.display = name === viewName ? "block" : "none";
    });

    // Update navigation active states
    document.querySelectorAll(".nav-links a").forEach((link) => {
      link.classList.remove("active");
    });

    // Set active class based on view
    if (viewName === "popularRecipes") {
      document.getElementById("popularRecipesLink").classList.add("active");
    } else if (
      viewName === "ingredientSelector" ||
      viewName === "recipeResults"
    ) {
      document.getElementById("findRecipesLink").classList.add("active");
    } else if (viewName === "aboutView") {
      document.getElementById("aboutLink").classList.add("active");
    }
  }

  // Navigation
  document.getElementById("homeButton").addEventListener("click", (e) => {
    e.preventDefault();
    showView("ingredientSelector");
  });

  document.getElementById("findRecipesLink").addEventListener("click", (e) => {
    e.preventDefault();
    showView("ingredientSelector");
  });

  document
    .getElementById("popularRecipesLink")
    .addEventListener("click", (e) => {
      e.preventDefault();
      renderPopularRecipes();
      showView("popularRecipes");
    });

  document.getElementById("aboutLink").addEventListener("click", (e) => {
    e.preventDefault();
    showView("aboutView");
  });

  document.querySelectorAll(".back-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const currentView = Object.entries(views).find(
        ([_, element]) => element.style.display === "block"
      )[0];

      if (currentView === "recipeDetails") {
        // Go back to previous view while maintaining the correct active nav item
        const previousView = document
          .getElementById("popularRecipesLink")
          .classList.contains("active")
          ? "popularRecipes"
          : "recipeResults";
        showView(previousView);
      } else {
        showView("ingredientSelector");
      }
    });
  });

  // Ingredient-based recipe matching
  function findMatchingRecipes(selectedIngredients) {
    const matches = [];
    for (const recipe of allRecipes) {
      if (!Array.isArray(recipe.requiredIngredients)) continue;
      const matchedRequired = recipe.requiredIngredients.filter((ing) =>
        selectedIngredients.includes(ing)
      );
      if (matchedRequired.length > 0) {
        const missingRequired = recipe.requiredIngredients.filter(
          (ing) => !selectedIngredients.includes(ing)
        );
        matches.push({
          ...recipe,
          matchCount: matchedRequired.length,
          matchPercentage:
            (matchedRequired.length / recipe.requiredIngredients.length) * 100,
          missingIngredients: missingRequired,
        });
      }
    }
    return matches.sort((a, b) => b.matchCount - a.matchCount);
  }

  // Recipe finding functionality
  findRecipesBtn.addEventListener("click", () => {
    try {
      const matchedRecipes = findMatchingRecipes(
        Array.from(selectedIngredients)
      );
      const recipeGrid = document.querySelector(".recipe-grid");
      recipeGrid.innerHTML = matchedRecipes
        .map(
          (recipe) => `
                <div class="recipe-card" data-recipe="${recipe.title}">
                    <div class="recipe-image">
                        <img src="${recipe.image}" alt="${recipe.title}">
                    </div>
                    <div class="recipe-content">
                        <h3>${recipe.title}</h3>
                        <p class="recipe-description">${recipe.description}</p>
                        <div class="missing-ingredients">
                            <span class="missing-label">Missing:</span>
                            <span class="missing-item">$${
                              recipe.missingIngredients.length > 0
                                ? recipe.missingIngredients.join(", ")
                                : "None"
                            }</span>
                        </div>
                        <button class="view-recipe-btn">View Recipe</button>
                    </div>
                </div>
            `
        )
        .join("");

      // Show selected ingredients summary
      const summaryContainer = document.querySelector(
        ".selected-ingredients-summary"
      );
      summaryContainer.innerHTML = Array.from(selectedIngredients)
        .map(
          (ingredient) =>
            `<span class="selected-ingredient">${ingredient}</span>`
        )
        .join("");

      // Add click handlers to recipe cards and view recipe buttons
      document.querySelectorAll(".recipe-grid .recipe-card").forEach((card) => {
        const viewButton = card.querySelector(".view-recipe-btn");
        if (viewButton) {
          viewButton.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const recipeName = card.dataset.recipe;
            const recipe = matchedRecipes.find((r) => r.title === recipeName);
            if (recipe) {
              displayRecipeDetails(recipe);
            }
          });
        }
      });

      showView("recipeResults");
    } catch (error) {
      console.error("Error finding recipes:", error);
      alert("Failed to find recipes. Please try again.");
    }
  });

  // Function to display recipe details
  function displayRecipeDetails(recipe) {
    const detailsView = document.getElementById("recipeDetails");
    const content = detailsView.querySelector(".recipe-content");

    content.querySelector(".recipe-category").textContent = recipe.category;
    content.querySelector("h1").textContent = recipe.title;
    content.querySelector(".recipe-subtitle").textContent = recipe.description;
    content.querySelector(".recipe-image img").src = recipe.image;
    content.querySelector(".recipe-image img").alt = recipe.title;

    // Update cooking info
    content.querySelector(
      ".cooking-time"
    ).textContent = `🕒 ${recipe.cookTime}`;
    content.querySelector(
      ".servings"
    ).textContent = `👥 ${recipe.servings} servings`;

    // Update instructions
    const instructionsList = content.querySelector(".instructions-list");
    instructionsList.innerHTML = recipe.instructions
      .map(
        (instruction, index) => `
            <li>
                <div class="step-number">${index + 1}</div>
                <div class="step-content">
                    <p>${instruction}</p>
                </div>
            </li>
        `
      )
      .join("");

    showView("recipeDetails");
  }

  // Render popular recipes dynamically
  function renderPopularRecipes() {
    // This function is now a no-op because popular recipes are static in index.php
    // and should not include user-added recipes.
    return;
  }

  // Message box close functionality
  const closeMessageBtn = document.querySelector(".close-message");
  const messageBox = document.getElementById("messageBox");
  if (closeMessageBtn && messageBox) {
    closeMessageBtn.addEventListener("click", () => {
      messageBox.style.display = "none";
    });
  }

  // User initial dropdown logic
  const userInitialBtn = document.getElementById("userInitialBtn");
  const userDropdown = document.getElementById("userDropdown");
  if (userInitialBtn && userDropdown) {
    userInitialBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      if (
        userDropdown.style.display === "none" ||
        userDropdown.style.display === ""
      ) {
        userDropdown.style.display = "block";
      } else {
        userDropdown.style.display = "none";
      }
    });
    document.addEventListener("click", function () {
      userDropdown.style.display = "none";
    });
  }
});
