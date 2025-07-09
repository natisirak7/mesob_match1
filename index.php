<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MesobMatch</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav class="navbar">
      <div class="nav-content">
        <a href="#" class="logo gradient-text" id="homeButton">MesobMatch</a>
        <div class="nav-right">
          <div class="nav-links">
            <a href="#" id="findRecipesLink" class="active">Find Recipes</a>
            <a href="#" id="popularRecipesLink">Popular Recipes</a>
            <a href="#" id="aboutLink">About</a>
          </div>
          <div class="user-menu-wrapper">
            <?php session_start(); ?>
            <?php if (isset($_SESSION['userid'])): ?>
              <div class="user-initial-btn" id="userInitialBtn" tabindex="0">
                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                <div class="user-dropdown" id="userDropdown" style="display:none; position:absolute; right:0; background:#fff; border:1px solid #ccc; border-radius:6px; box-shadow:0 2px 8px rgba(0,0,0,0.08); min-width:120px; z-index:1000;">
                  <a href="dashboard.php" class="user-menu-link" style="display:block; padding:8px 16px; color:#333; text-decoration:none;">Dashboard</a>
                  <a href="logout.php" class="user-menu-link" style="display:block; padding:8px 16px; color:#333; text-decoration:none;">Logout</a>
                </div>
              </div>
            <?php else: ?>
              <a href="login.php" id="userIconLink" class="user-icon-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24">
                  <circle cx="12" cy="8" r="4" stroke="#ff9800" stroke-width="2"/>
                  <path d="M4 20c0-2.21 3.582-4 8-4s8 1.79 8 4" stroke="#ff9800" stroke-width="2"/>
                </svg>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
      <!-- Ingredient Selection View -->
      <div id="ingredientSelector" class="view">
        <header>
          <h1>Find Your Recipe</h1>
          <p>Select the ingredients you have available</p>
        </header>

        <main class="ingredient-selector">
          <!-- Ingredients Panel -->
          <div class="ingredients-panel">
            <!-- Proteins -->
            <section class="ingredient-category">
              <h2>Proteins</h2>
              <div class="ingredient-grid">
                <button class="ingredient-btn" data-ingredient="beef">
                  Beef
                </button>
                <button class="ingredient-btn" data-ingredient="chicken">
                  Chicken
                </button>
                <button class="ingredient-btn" data-ingredient="fish">
                  Fish
                </button>
                <button class="ingredient-btn" data-ingredient="lamb">
                  Lamb
                </button>
                <button class="ingredient-btn" data-ingredient="goat">
                  Goat
                </button>
              </div>
            </section>

            <!-- Vegetables -->
            <section class="ingredient-category">
              <h2>Vegetables</h2>
              <div class="ingredient-grid">
                <button class="ingredient-btn" data-ingredient="shiro">
                  Shiro
                </button>
                <button class="ingredient-btn" data-ingredient="lentils">
                  Lentils
                </button>
                <button class="ingredient-btn" data-ingredient="onion">
                  Onion
                </button>
                <button class="ingredient-btn" data-ingredient="tomato">
                  Tomato
                </button>
                <button class="ingredient-btn" data-ingredient="potato">
                  Potato
                </button>
                <button class="ingredient-btn" data-ingredient="carrot">
                  Carrot
                </button>
                <button class="ingredient-btn" data-ingredient="garlic">
                  Garlic
                </button>
                <button class="ingredient-btn" data-ingredient="ginger">
                  Ginger
                </button>
                <button class="ingredient-btn" data-ingredient="spinach">
                  Spinach
                </button>
                <button class="ingredient-btn" data-ingredient="cabbage">
                  Cabbage
                </button>
              </div>
            </section>

            <!-- Spices -->
            <section class="ingredient-category">
              <h2>Spices & Seasonings</h2>
              <div class="ingredient-grid">
                <button class="ingredient-btn" data-ingredient="berbere">
                  Berbere
                </button>
                <button class="ingredient-btn" data-ingredient="mitmita">
                  Mitmita
                </button>
                <button class="ingredient-btn" data-ingredient="blackPepper">
                  Black Pepper
                </button>
                <button class="ingredient-btn" data-ingredient="cumin">
                  Cumin
                </button>
                <button class="ingredient-btn" data-ingredient="turmeric">
                  Turmeric
                </button>
                <button class="ingredient-btn" data-ingredient="rosemary">
                  Rosemary
                </button>
              </div>
            </section>
          </div>
          <!-- Group Add Recipe Button and Selected Panel in the Same Column -->
          <div class="selected-panel-group">
            <div class="add-recipe-btn-container">
              <a href="<?php
                if (isset($_SESSION['userid'])) {
                  echo 'dashboard.php';
                } else {
                  echo 'login.php';
                }
              ?>" id="addRecipeBtn" class="add-recipe-btn">Add Recipe</a>
            </div>
            <div class="selected-panel">
              <h2>Selected Ingredients</h2>
              <div id="selectedIngredients" class="selected-ingredients"></div>
              <button id="findRecipes" class="find-recipes-btn" disabled>
                Find Recipes
              </button>
            </div>
          </div>
        </main>
      </div>

      <!-- Popular Recipes View -->
      <div id="popularRecipes" class="view">
        <header>
          <h1>Popular Recipes</h1>
          <p>Most loved Ethiopian dishes</p>
        </header>
        <div id="popularRecipesGrid" class="popular-recipes-grid">
          <div class="recipe-card featured">
            <div class="recipe-image">
              <img src="mesob_match_picture\recipe_686cbdc698a1c_Gemini_Generated_Image_4jea7m4jea7m4jea.png" alt="Doro Wat" />
            </div>
            <div class="recipe-content">
              <div class="recipe-category">Chicken Stew</div>
              <h3>Doro Wat</h3>
              <p class="recipe-description">Often considered the national dish of Ethiopia, Doro Wat is a spicy and rich chicken stew. It's made with tender chicken pieces slow-cooked in a vibrant sauce of berbere (a key Ethiopian spice blend), onions, garlic, ginger, and niter kibbeh (spiced clarified butter). It typically includes hard-boiled eggs.</p>
              <button class="popular-recipe-btn" onclick="toggleRecipeSection('doroWatSection')">Recipes</button>
              <div id="doroWatSection" class="recipe-details-section" style="display:none;">
                <h4>Ingredients:</h4>
                <ul>
                  <li>1 cup unsalted butter, divided (or niter kibbeh)</li>
                  <li>1 large onion, finely chopped</li>
                  <li>2 ½ cups water, divided</li>
                  <li>1 (6 ounce) can tomato paste</li>
                  <li>¾ cup berbere seasoning (adjust to your spice preference)</li>
                  <li>1 teaspoon chopped garlic</li>
                  <li>½ teaspoon ground ginger</li>
                  <li>4 skinless, boneless chicken breasts, cubed (or bone-in chicken pieces)</li>
                  <li>⅓ cup sweet white wine (optional)</li>
                  <li>½ teaspoon ground cardamom (or korerima)</li>
                  <li>½ teaspoon freshly ground black pepper</li>
                  <li>4 hard-cooked eggs</li>
                </ul>
                <h4>Instructions:</h4>
                <ol>
                  <li>Melt ½ cup butter (or niter kibbeh) in a skillet over medium-low heat. Add chopped onion and cook until translucent (5-6 minutes).</li>
                  <li>Add ½ cup water and tomato paste; stir until hot (about 2 minutes). Stir in berbere, remaining ½ cup butter, garlic, and ginger. Reduce heat to low and cook until the mixture thickens to a paste (20-30 minutes).</li>
                  <li>Stir the remaining 2 cups of water into the berbere paste and add the chicken. Simmer until the sauce thickens (about 45 minutes).</li>
                  <li>Stir in wine (if using), cardamom, and black pepper. Add hard-cooked eggs. Cook until the sauce is slightly reduced (about 15 minutes more).</li>
                  <li>Serve hot, traditionally with injera.</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="recipe-card featured">
            <div class="recipe-image">
              <img src="mesob_match_picture\Gemini_Generated_Image_uad3mpuad3mpuad3.png" alt="Tibs" />
            </div>
            <div class="recipe-content">
              <div class="recipe-category">Sautéed Meat</div>
              <h3>Tibs</h3>
              <p class="recipe-description">This dish consists of sautéed or grilled pieces of meat (commonly beef, lamb, or goat, and sometimes chicken) cooked with onions, peppers, garlic, and various spices. Tibs can range from hot to mild and are frequently served on a hot plate. There are many variations, like Awaze Tibs (spicy) or Shekla Tibs (served in a clay pot).</p>
              <button class="popular-recipe-btn" onclick="toggleRecipeSection('tibsSection')">Recipes</button>
              <div id="tibsSection" class="recipe-details-section" style="display:none;">
                <h4>Ingredients (for Beef Tibs):</h4>
                <ul>
                  <li>1.5 lbs beef, bite-sized pieces</li>
                  <li>⅓ cup niter kibbeh (Ethiopian clarified butter) or olive oil + plain unsalted butter</li>
                  <li>½ onion, chopped</li>
                  <li>2 cloves garlic, minced</li>
                  <li>1 jalapeno pepper, sliced (optional, for heat)</li>
                  <li>1 teaspoon berbere</li>
                  <li>3 tablespoon olive oil</li>
                  <li>1 tablespoon lemon juice</li>
                  <li>½ teaspoon salt</li>
                  <li>½ teaspoon black pepper</li>
                  <li>Cilantro for garnish (optional)</li>
                </ul>
                <h4>Instructions:</h4>
                <ol>
                  <li>Wash and drain the beef pieces.</li>
                  <li>Chop onions, slice jalapeno (if using), and mince garlic.</li>
                  <li>In a large skillet, heat 3 tablespoons of olive oil. Add the chopped beef and season with salt, black pepper, and 1 teaspoon berbere. Stir on high heat until browned. Remove the beef and set aside.</li>
                  <li>Melt niter kibbeh (or plain butter) in the same skillet. Add chopped onions and minced garlic. Sauté for a few minutes. Add sliced jalapeno peppers (if using) and sauté for a few more minutes.</li>
                  <li>If making Awaze Tibs, you can create an Awaze paste by mixing 3 tbsp berbere, 1 tsp black pepper, ½ tsp cumin, ½ tsp ground ginger, ½ tsp salt with ¼ cup water and 1 tbsp olive oil, then adding this paste to the skillet.</li>
                  <li>Add the browned beef back into the skillet with the onion mixture and Awaze sauce (if using). Simmer for 5 minutes on low heat.</li>
                  <li>Stir in the lemon juice and simmer for a few more minutes on medium heat until the beef is cooked to your desired doneness.</li>
                  <li>Garnish with cilantro and serve hot with injera.</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="recipe-card featured">
            <div class="recipe-image">
              <img src="mesob_match_picture\Gemini_Generated_Image_6a436g6a436g6a43.png" alt="Kitfo" />
            </div>
            <div class="recipe-content">
              <div class="recipe-category">Minced Beef</div>
              <h3>Kitfo</h3>
              <p class="recipe-description">For the more adventurous eater, Kitfo is a highly prized dish made from raw, minced beef. It's seasoned with mitmita (a chili powder-based spice blend) and niter kibbeh. While traditionally served raw ("leb leb"), it can also be lightly cooked ("betam leb leb") for those who prefer. It's often accompanied by a mild cheese called ayib and collard greens (gomen).</p>
              <button class="popular-recipe-btn" onclick="toggleRecipeSection('kitfoSection')">Recipes</button>
              <div id="kitfoSection" class="recipe-details-section" style="display:none;">
                <h4>Ingredients:</h4>
                <ul>
                  <li>2 pounds lean beef (e.g., top round), freshly cut and finely minced (traditionally by hand or meat grinder)</li>
                  <li>7 tsp mitmita kitfo spice blend (a blend of chili powder, cardamom, cloves, salt, etc.)</li>
                  <li>4 tbsp niter kibbeh (Ethiopian spiced clarified butter)</li>
                  <li>¼ tsp garlic powder (optional)</li>
                  <li>Salt and pepper to taste</li>
                  <li>Ayib (Ethiopian cottage cheese) and Gomen (collard greens) for serving (optional)</li>
                  <li>Injera and/or Kocho for serving</li>
                </ul>
                <h4>Instructions:</h4>
                <ol>
                  <li>Ensure beef is finely minced.</li>
                  <li>In a small pot over low heat, melt the niter kibbeh. Add the mitmita kitfo spice blend and garlic powder (if using). Stir to combine.</li>
                  <li>Thoroughly mix the finely minced beef with the spiced butter mixture using a fork or spoon until the meat is fully marinated.</li>
                  <li>Season with salt and pepper to taste.</li>
                  <li>Serve immediately while still raw (for traditional kitfo). If preferred, you can lightly cook the marinated meat for 2-3 minutes in a pan over low heat until it's barely heated through ("leb leb").</li>
                  <li>Serve with injera, and optionally with ayib and gomen, or kocho.</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="recipe-card featured">
            <div class="recipe-image">
              <img src="mesob_match_picture\Gemini_Generated_Image_pntgpfpntgpfpntg.png" alt="Shiro Wat" />
            </div>
            <div class="recipe-content">
              <div class="recipe-category">Chickpea Stew</div>
              <h3>Shiro Wat</h3>
              <p class="recipe-description">This is a thick, flavorful stew made primarily from ground chickpeas or lentils, slow-cooked with berbere and other spices, often including onions and garlic. Shiro is a staple, especially popular during fasting periods (when many Ethiopians abstain from meat) due to its delicious and satisfying vegetarian nature.</p>
              <button class="popular-recipe-btn" onclick="toggleRecipeSection('shiroWatSection')">Recipes</button>
              <div id="shiroWatSection" class="recipe-details-section" style="display:none;">
                <h4>Ingredients:</h4>
                <ul>
                  <li>1 cup chickpea flour (besan)</li>
                  <li>1 cup chopped red onion</li>
                  <li>1-2 cloves garlic, minced (or more to taste)</li>
                  <li>1 cup chopped tomato</li>
                  <li>1½ tablespoons Berbere Spice Blend (adjust to taste)</li>
                  <li>½ teaspoon ground cardamom (optional)</li>
                  <li>1 teaspoon tahini or cashew butter (optional, for creaminess)</li>
                  <li>2 tablespoons lemon juice</li>
                  <li>6-7 cups water (adjust for desired consistency)</li>
                  <li>Sea salt, to taste</li>
                  <li>Niter kibbeh or olive oil (for cooking base)</li>
                </ul>
                <h4>Instructions:</h4>
                <ol>
                  <li>Toast Chickpea Flour (Optional but Recommended for deeper flavor): Heat a large nonstick skillet over medium-low heat. Add chickpea flour; cook for 10-15 minutes or until flour releases a toasted aroma, stirring frequently. Transfer to a large bowl and let cool.</li>
                  <li>In a large saucepan, add a little niter kibbeh or olive oil (if using) and sauté the chopped onion and minced garlic until tender and translucent (about 10 minutes). If not using oil, you can dry-sauté the onions until they release their liquid and soften.</li>
                  <li>Add chopped tomato, Berbere Spice Blend, and cardamom (if using) to the saucepan. Cook for another 10 minutes, stirring occasionally.</li>
                  <li>In the bowl with the toasted chickpea flour (or untoasted, if skipping step 1), whisk in 6 cups of water (add gradually to avoid lumps) until smooth. You can also add tahini and lemon juice at this stage and whisk well.</li>
                  <li>Add the chickpea flour mixture to the saucepan with the onion and tomato mixture. Bring the mixture to a boil, then reduce heat to low. Cover and cook for 30 minutes, or until the stew is thickened to your desired consistency, stirring occasionally to prevent sticking. Add more water if it becomes too thick.</li>
                  <li>Season with sea salt to taste.</li>
                  <li>Serve hot, traditionally with injera.</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recipe Results View -->
      <div id="recipeResults" class="view" style="display: none">
        <header>
          <div class="results-header">
            <div class="results-title">
              <h1>Matching Recipes</h1>
              <p>Based on your ingredients</p>
            </div>
            <button class="back-btn glass-effect">←</button>
          </div>
          <div
            id="selectedIngredientsSummary"
            class="selected-ingredients-summary"
          ></div>
        </header>
        <div class="recipe-grid"></div>
      </div>

      <!-- Recipe Details View -->
      <div id="recipeDetails" class="view" style="display: none">
        <header>
          <div class="results-header">
            <button class="back-btn glass-effect">←</button>
          </div>
        </header>
        <div class="recipe-content">
          <div class="recipe-category"></div>
          <h1></h1>
          <p class="recipe-subtitle"></p>
          <div class="recipe-image">
            <img src="" alt="" />
          </div>
          <div class="recipe-info">
            <div class="cooking-time"></div>
            <div class="servings"></div>
          </div>
          <div class="recipe-instructions">
            <h2>Instructions</h2>
            <ol class="instructions-list"></ol>
          </div>
        </div>
      </div>

      <!-- About View -->
      <div id="aboutView" class="view" style="display: none">
        <header>
          <h1>About MesobMatch</h1>
          <p>Discover the Rich Flavors of Ethiopian Cuisine</p>
        </header>

        <div class="about-content">
          <section class="about-section">
            <h2>What is MesobMatch?</h2>
            <p>
              MesobMatch is your gateway to authentic Ethiopian cuisine. Our
              platform helps you discover traditional Ethiopian recipes based on
              the ingredients you have available. Whether you're an experienced
              cook or new to Ethiopian cuisine, MesobMatch makes it easy to find
              and prepare delicious Ethiopian dishes.
            </p>
          </section>

          <section class="about-section">
            <h2>Ethiopian Cuisine</h2>
            <p>
              Ethiopian cuisine is known for its rich flavors, unique spice
              blends, and communal dining culture. Central to Ethiopian cooking
              are key ingredients like berbere (a complex spice blend), niter
              kibbeh (spiced clarified butter), and injera (sourdough
              flatbread). Dishes are typically served on injera, which serves
              both as a plate and utensil.
            </p>
          </section>

          <section class="about-section">
            <h2>Types of Dishes</h2>
            <div class="dish-types">
              <div class="dish-type">
                <h3>Wot (ወጥ)</h3>
                <p>
                  Stews that can be spicy (key) or mild (alicha), made with meat
                  or vegetables.
                </p>
              </div>
              <div class="dish-type">
                <h3>Tibs (ጥብስ)</h3>
                <p>
                  Sautéed meat dishes with vegetables, known for their
                  tenderness and flavor.
                </p>
              </div>
              <div class="dish-type">
                <h3>Shiro (ሽሮ)</h3>
                <p>
                  A thick stew made from ground chickpeas or fava beans, a
                  staple in Ethiopian cuisine.
                </p>
              </div>
              <div class="dish-type">
                <h3>Misir (ምስር)</h3>
                <p>
                  Lentil dishes that can be spicy or mild, rich in protein and
                  flavor.
                </p>
              </div>
            </div>
          </section>

          

    <script type="module" src="script.js"></script>
    <script>
      function toggleRecipeSection(id) {
        // Collapse all sections first
        document.querySelectorAll('.recipe-details-section').forEach(function(section) {
          if (section.id === id) {
            section.style.display = (section.style.display === 'block') ? 'none' : 'block';
          } else {
            section.style.display = 'none';
          }
        });
      }
      document.addEventListener('DOMContentLoaded', function() {
        var userMenuWrapper = document.querySelector('.user-menu-wrapper');
        var userInitialBtn = document.getElementById('userInitialBtn');
        var userDropdown = document.getElementById('userDropdown');
        if (userMenuWrapper && userInitialBtn && userDropdown) {
          function showDropdown() {
            userMenuWrapper.classList.add('active');
          }
          function hideDropdown() {
            userMenuWrapper.classList.remove('active');
          }
          userInitialBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (userMenuWrapper.classList.contains('active')) {
              hideDropdown();
            } else {
              showDropdown();
            }
          });
          document.addEventListener('click', hideDropdown);
        }
      });
    </script>
  </body>
</html>

<!-- Recipe Modals -->
<div id="doroWatModal" class="recipe-modal" style="display:none;">
  <div class="recipe-modal-content">
    <span class="close-modal" onclick="closeRecipeModal('doroWatModal')">&times;</span>
    <h2>Doro Wat (Ethiopian Chicken Stew)</h2>
    <p>Doro Wat is a rich, spicy chicken stew, often considered the national dish.</p>
    <h3>Ingredients:</h3>
    <ul>
      <li>1 cup unsalted butter, divided (or niter kibbeh)</li>
      <li>1 large onion, finely chopped</li>
      <li>2 ½ cups water, divided</li>
      <li>1 (6 ounce) can tomato paste</li>
      <li>¾ cup berbere seasoning (adjust to your spice preference)</li>
      <li>1 teaspoon chopped garlic</li>
      <li>½ teaspoon ground ginger</li>
      <li>4 skinless, boneless chicken breasts, cubed (or bone-in chicken pieces)</li>
      <li>⅓ cup sweet white wine (optional)</li>
      <li>½ teaspoon ground cardamom (or korerima)</li>
      <li>½ teaspoon freshly ground black pepper</li>
      <li>4 hard-cooked eggs</li>
    </ul>
    <h3>Instructions:</h3>
    <ol>
      <li>Melt ½ cup butter (or niter kibbeh) in a skillet over medium-low heat. Add chopped onion and cook until translucent (5-6 minutes).</li>
      <li>Add ½ cup water and tomato paste; stir until hot (about 2 minutes). Stir in berbere, remaining ½ cup butter, garlic, and ginger. Reduce heat to low and cook until the mixture thickens to a paste (20-30 minutes).</li>
      <li>Stir the remaining 2 cups of water into the berbere paste and add the chicken. Simmer until the sauce thickens (about 45 minutes).</li>
      <li>Stir in wine (if using), cardamom, and black pepper. Add hard-cooked eggs. Cook until the sauce is slightly reduced (about 15 minutes more).</li>
      <li>Serve hot, traditionally with injera.</li>
    </ol>
  </div>
</div>
<div id="tibsModal" class="recipe-modal" style="display:none;">
  <div class="recipe-modal-content">
    <span class="close-modal" onclick="closeRecipeModal('tibsModal')">&times;</span>
    <h2>Tibs (Sautéed Meat)</h2>
    <p>Tibs is a versatile dish of sautéed meat, commonly beef or lamb, cooked with various aromatics and spices.</p>
    <h3>Ingredients (for Beef Tibs):</h3>
    <ul>
      <li>1.5 lbs beef, bite-sized pieces</li>
      <li>⅓ cup niter kibbeh (Ethiopian clarified butter) or olive oil + plain unsalted butter</li>
      <li>½ onion, chopped</li>
      <li>2 cloves garlic, minced</li>
      <li>1 jalapeno pepper, sliced (optional, for heat)</li>
      <li>1 teaspoon berbere</li>
      <li>3 tablespoon olive oil</li>
      <li>1 tablespoon lemon juice</li>
      <li>½ teaspoon salt</li>
      <li>½ teaspoon black pepper</li>
      <li>Cilantro for garnish (optional)</li>
    </ul>
    <h3>Instructions:</h3>
    <ol>
      <li>Wash and drain the beef pieces.</li>
      <li>Chop onions, slice jalapeno (if using), and mince garlic.</li>
      <li>In a large skillet, heat 3 tablespoons of olive oil. Add the chopped beef and season with salt, black pepper, and 1 teaspoon berbere. Stir on high heat until browned. Remove the beef and set aside.</li>
      <li>Melt niter kibbeh (or plain butter) in the same skillet. Add chopped onions and minced garlic. Sauté for a few minutes. Add sliced jalapeno peppers (if using) and sauté for a few more minutes.</li>
      <li>If making Awaze Tibs, you can create an Awaze paste by mixing 3 tbsp berbere, 1 tsp black pepper, ½ tsp cumin, ½ tsp ground ginger, ½ tsp salt with ¼ cup water and 1 tbsp olive oil, then adding this paste to the skillet.</li>
      <li>Add the browned beef back into the skillet with the onion mixture and Awaze sauce (if using). Simmer for 5 minutes on low heat.</li>
      <li>Stir in the lemon juice and simmer for a few more minutes on medium heat until the beef is cooked to your desired doneness.</li>
      <li>Garnish with cilantro and serve hot with injera.</li>
    </ol>
  </div>
</div>
<div id="kitfoModal" class="recipe-modal" style="display:none;">
  <div class="recipe-modal-content">
    <span class="close-modal" onclick="closeRecipeModal('kitfoModal')">&times;</span>
    <h2>Kitfo (Ethiopian Steak Tartare)</h2>
    <p>Kitfo is a traditional dish of finely minced raw beef, highly prized for its unique flavor and texture. It can also be lightly cooked ("leb leb").</p>
    <h3>Ingredients:</h3>
    <ul>
      <li>2 pounds lean beef (e.g., top round), freshly cut and finely minced (traditionally by hand or meat grinder)</li>
      <li>7 tsp mitmita kitfo spice blend (a blend of chili powder, cardamom, cloves, salt, etc.)</li>
      <li>4 tbsp niter kibbeh (Ethiopian spiced clarified butter)</li>
      <li>¼ tsp garlic powder (optional)</li>
      <li>Salt and pepper to taste</li>
      <li>Ayib (Ethiopian cottage cheese) and Gomen (collard greens) for serving (optional)</li>
      <li>Injera and/or Kocho for serving</li>
    </ul>
    <h3>Instructions:</h3>
    <ol>
      <li>Ensure beef is finely minced.</li>
      <li>In a small pot over low heat, melt the niter kibbeh. Add the mitmita kitfo spice blend and garlic powder (if using). Stir to combine.</li>
      <li>Thoroughly mix the finely minced beef with the spiced butter mixture using a fork or spoon until the meat is fully marinated.</li>
      <li>Season with salt and pepper to taste.</li>
      <li>Serve immediately while still raw (for traditional kitfo). If preferred, you can lightly cook the marinated meat for 2-3 minutes in a pan over low heat until it's barely heated through ("leb leb").</li>
      <li>Serve with injera, and optionally with ayib and gomen, or kocho.</li>
    </ol>
  </div>
</div>
<div id="shiroWatModal" class="recipe-modal" style="display:none;">
  <div class="recipe-modal-content">
    <span class="close-modal" onclick="closeRecipeModal('shiroWatModal')">&times;</span>
    <h2>Shiro Wat (Chickpea Flour Stew)</h2>
    <p>Shiro Wat is a thick, flavorful vegetarian stew made from ground chickpeas or lentils, a staple during fasting periods.</p>
    <h3>Ingredients:</h3>
    <ul>
      <li>1 cup chickpea flour (besan)</li>
      <li>1 cup chopped red onion</li>
      <li>1-2 cloves garlic, minced (or more to taste)</li>
      <li>1 cup chopped tomato</li>
      <li>1½ tablespoons Berbere Spice Blend (adjust to taste)</li>
      <li>½ teaspoon ground cardamom (optional)</li>
      <li>1 teaspoon tahini or cashew butter (optional, for creaminess)</li>
      <li>2 tablespoons lemon juice</li>
      <li>6-7 cups water (adjust for desired consistency)</li>
      <li>Sea salt, to taste</li>
      <li>Niter kibbeh or olive oil (for cooking base)</li>
    </ul>
    <h3>Instructions:</h3>
    <ol>
      <li>Toast Chickpea Flour (Optional but Recommended for deeper flavor): Heat a large nonstick skillet over medium-low heat. Add chickpea flour; cook for 10-15 minutes or until flour releases a toasted aroma, stirring frequently. Transfer to a large bowl and let cool.</li>
      <li>In a large saucepan, add a little niter kibbeh or olive oil (if using) and sauté the chopped onion and minced garlic until tender and translucent (about 10 minutes). If not using oil, you can dry-sauté the onions until they release their liquid and soften.</li>
      <li>Add chopped tomato, Berbere Spice Blend, and cardamom (if using) to the saucepan. Cook for another 10 minutes, stirring occasionally.</li>
      <li>In the bowl with the toasted chickpea flour (or untoasted, if skipping step 1), whisk in 6 cups of water (add gradually to avoid lumps) until smooth. You can also add tahini and lemon juice at this stage and whisk well.</li>
      <li>Add the chickpea flour mixture to the saucepan with the onion and tomato mixture. Bring the mixture to a boil, then reduce heat to low. Cover and cook for 30 minutes, or until the stew is thickened to your desired consistency, stirring occasionally to prevent sticking. Add more water if it becomes too thick.</li>
      <li>Season with sea salt to taste.</li>
      <li>Serve hot, traditionally with injera.</li>
    </ol>
  </div>
</div>

<script>
function showRecipeModal(id) {
  document.getElementById(id).style.display = 'block';
}
function closeRecipeModal(id) {
  document.getElementById(id).style.display = 'none';
}
window.onclick = function(event) {
  var modals = document.querySelectorAll('.recipe-modal');
  modals.forEach(function(modal) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });
}
</script>
