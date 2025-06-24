import { findMatchingRecipes } from "./recipes.js";

document.addEventListener("DOMContentLoaded", () => {
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
    Object.entries(views).forEach(([name, element]) => {
      element.style.display = name === viewName ? "block" : "none";
    });

    document.querySelectorAll(".nav-links a").forEach((link) => {
      link.classList.remove("active");
    });

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

  findRecipesBtn.addEventListener("click", () => {
    try {
      const matchedRecipes = findMatchingRecipes(
        Array.from(selectedIngredients)
      );

      // Update the results view
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
                            <span class="missing-item">${
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

      const summaryContainer = document.querySelector(
        ".selected-ingredients-summary"
      );
      summaryContainer.innerHTML = Array.from(selectedIngredients)
        .map(
          (ingredient) =>
            `<span class="selected-ingredient">${ingredient}</span>`
        )
        .join("");

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

  function displayRecipeDetails(recipe) {
    const detailsView = document.getElementById("recipeDetails");
    const content = detailsView.querySelector(".recipe-content");

    content.querySelector(".recipe-category").textContent = recipe.category;
    content.querySelector("h1").textContent = recipe.title;
    content.querySelector(".recipe-subtitle").textContent = recipe.description;
    content.querySelector(".recipe-image img").src = recipe.image;
    content.querySelector(".recipe-image img").alt = recipe.title;

    content.querySelector(
      ".cooking-time"
    ).textContent = `🕒 ${recipe.cookTime}`;
    content.querySelector(
      ".servings"
    ).textContent = `👥 ${recipe.servings} servings`;

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

  const popularRecipesSection = document.getElementById("popularRecipes");
  if (popularRecipesSection) {
    const viewButtons =
      popularRecipesSection.querySelectorAll(".view-recipe-btn");
    viewButtons.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const recipeCard = e.target.closest(".recipe-card");
        const recipeName = recipeCard.querySelector("h3").textContent;

        const recipe = {
          title: recipeName,
          category: recipeCard.querySelector(".recipe-category").textContent,
          description: recipeCard.querySelector(".recipe-description")
            .textContent,
          image: recipeCard.querySelector(".recipe-image img").src,
          cookTime: "30-45 mins",
          servings: 4,
          instructions: [
            "Heat oil in a large pot over medium heat",
            "Add diced onions and cook until translucent",
            "Add minced garlic and ginger, cook until fragrant",
            "Add berbere spice blend (for spicy dishes) or turmeric (for mild dishes)",
            "Add your main ingredients and stir well",
            "Add water or stock, bring to a simmer",
            "Cook until all ingredients are tender and flavors have melded",
            "Adjust seasoning to taste",
            "Serve hot with injera bread",
          ],
        };

        displayRecipeDetails(recipe);
      });
    });
  }
});
