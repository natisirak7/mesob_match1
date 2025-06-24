const ethiopianRecipes = {
  // Key Wot (Red Stews) - Meat Based
  "Doro Wat": {
    title: "Doro Wat (Chicken Stew)",
    category: "Key Wot",
    cookTime: "45 mins",
    servings: 4,
    image: "./mesob_match_picture/Gemini_Generated_Image_4jea7m4jea7m4jea.png",
    description:
      "The national dish of Ethiopia - a spicy chicken stew made with berbere spice blend.",
    requiredIngredients: [
      "chicken",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
    ],
    optionalIngredients: ["rosemary"],
    instructions: [
      "Prepare wot base by sautéing onions until golden brown (15-20 minutes)",
      "Add minced garlic and ginger, cook until fragrant (2-3 minutes)",
      "Add berbere and cook while stirring (5 minutes)",
      "Add chicken pieces and brown lightly",
      "Add water to cover halfway and simmer until tender (30-45 minutes)",
      "Season with salt and black pepper to taste",
    ],
  },
  "Key Siga Wot": {
    title: "Key Siga Wot (Red Beef Stew)",
    category: "Key Wot",
    cookTime: "2.5 hours",
    servings: 6,
    image: "mesob_match_pictureGemini_Generated_Image_28atw28atw28atw2.png",
    description:
      "A rich and spicy Ethiopian beef stew simmered in berbere sauce until meltingly tender.",
    requiredIngredients: [
      "beef",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "cumin",
      "turmeric",
    ],
    optionalIngredients: ["rosemary"],
    instructions: [
      "Prepare wot base with onions until deeply caramelized",
      "Add garlic and ginger, sauté until aromatic",
      "Add beef cubes and brown on all sides",
      "Add berbere and remaining spices",
      "Add water and simmer until beef is very tender (1.5-2.5 hours)",
      "Adjust seasoning with salt and spices",
    ],
  },
  "YeBeg Key Wot": {
    title: "YeBeg Key Wot (Red Lamb Stew)",
    category: "Key Wot",
    cookTime: "1.5 hours",
    servings: 6,
    image: "mesob_match_pictureGemini_Generated_Image_28atw28atw28atw2.png",
    description: "A hearty Ethiopian lamb stew in rich berbere sauce.",
    requiredIngredients: [
      "lamb",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "cumin",
      "turmeric",
    ],
    optionalIngredients: ["rosemary"],
    instructions: [
      "Brown lamb pieces in a large pot",
      "Remove lamb and sauté onions until golden",
      "Add garlic, ginger, and spices",
      "Return lamb and add berbere",
      "Simmer until lamb is tender (1-1.5 hours)",
      "Season to taste",
    ],
  },
  "YeFessas Key Wot": {
    title: "YeFessas Key Wot (Red Goat Stew)",
    category: "Key Wot",
    cookTime: "2.5 hours",
    servings: 6,
    image: "./images/yefessas-key-wot.jpg",
    description: "Traditional Ethiopian goat stew in spicy berbere sauce.",
    requiredIngredients: [
      "goat",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "cumin",
      "turmeric",
    ],
    optionalIngredients: ["rosemary"],
    instructions: [
      "Prepare wot base with caramelized onions",
      "Add garlic, ginger, and spices",
      "Add goat meat and brown well",
      "Add berbere and water",
      "Simmer until goat is tender (2-2.5 hours)",
      "Season to taste",
    ],
  },
  "Ye'Asa Key Wot": {
    title: "Ye'Asa Key Wot (Red Fish Stew)",
    category: "Key Wot",
    cookTime: "25 mins",
    servings: 4,
    image: "./images/yeasa-key-wot.jpg",
    description: "Delicate fish stew in aromatic berbere sauce.",
    requiredIngredients: [
      "fish",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "cumin",
    ],
    optionalIngredients: ["turmeric"],
    instructions: [
      "Prepare wot base with onions, garlic, and ginger",
      "Add berbere and spices",
      "Gently add fish pieces",
      "Simmer until fish is just cooked (10-15 minutes)",
      "Season carefully to avoid breaking the fish",
    ],
  },

  // Alicha Wot (Mild Stews)
  "Ye'Beg Alicha Wot": {
    title: "Ye'Beg Alicha Wot (Mild Lamb Stew)",
    category: "Alicha Wot",
    cookTime: "1.5 hours",
    servings: 6,
    image: "./images/yebereg-alicha-wot.jpg",
    description: "Mild, turmeric-spiced lamb stew.",
    requiredIngredients: [
      "lamb",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Sauté onions until soft",
      "Add garlic and ginger",
      "Add turmeric, cumin, and black pepper",
      "Add lamb and brown lightly",
      "Add water and simmer until tender (1-1.5 hours)",
      "Season with salt",
    ],
  },
  "Ye'Fessas Alicha Wot": {
    title: "Ye'Fessas Alicha Wot (Mild Goat Stew)",
    category: "Alicha Wot",
    cookTime: "2.5 hours",
    servings: 6,
    image: "./images/yefessas-alicha-wot.jpg",
    description: "Mild goat stew seasoned with turmeric and aromatics.",
    requiredIngredients: [
      "goat",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Follow same preparation as Ye'Bereg Alicha Wot",
      "Simmer until goat is very tender (2-2.5 hours)",
    ],
  },

  // Mixed Stews
  "Dinich Key Wot Be Siga": {
    title: "Dinich Key Wot Be Siga (Potato & Beef Red Stew)",
    category: "Mixed Stews",
    cookTime: "2 hours",
    servings: 6,
    image: "mesob_match_pictureGemini_Generated_Image_pva9yxpva9yxpva9.png",
    description:
      "Hearty stew combining tender beef and potatoes in berbere sauce.",
    requiredIngredients: [
      "beef",
      "potato",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
    ],
    optionalIngredients: ["cumin"],
    instructions: [
      "Prepare wot base",
      "Add beef and simmer until almost tender",
      "Add cubed potatoes",
      "Continue cooking until potatoes are done and beef is tender",
      "Season to taste",
    ],
  },
  "Karot Alicha Wot Be Doro": {
    title: "Karot Alicha Wot Be Doro (Carrot & Chicken Mild Stew)",
    category: "Mixed Stews",
    cookTime: "45 mins",
    servings: 4,
    image: "./images/karot-alicha-wot-be-doro.jpg",
    description: "Mild chicken and carrot stew seasoned with turmeric.",
    requiredIngredients: [
      "chicken",
      "carrot",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Prepare alicha base with onions, garlic, ginger, and spices",
      "Add chicken and brown",
      "Add water and simmer until chicken is almost done",
      "Add carrots and cook until tender",
    ],
  },

  // Vegetarian Wot
  "Dinich Key Wot": {
    title: "Dinich Key Wot (Red Potato Stew)",
    category: "Vegetarian",
    cookTime: "40 mins",
    servings: 4,
    image: "./images/dinich-key-wot.jpg",
    description: "Spicy potato stew in berbere sauce.",
    requiredIngredients: [
      "potato",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
    ],
    optionalIngredients: ["cumin", "turmeric"],
    instructions: [
      "Prepare wot base",
      "Add cubed potatoes",
      "Add water and simmer until tender",
      "Season to taste",
    ],
  },
  "Karot Key Wot": {
    title: "Karot Key Wot (Red Carrot Stew)",
    category: "Vegetarian",
    cookTime: "30 mins",
    servings: 4,
    image: "./images/karot-key-wot.jpg",
    description: "Spicy carrot stew in berbere sauce.",
    requiredIngredients: [
      "carrot",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Prepare wot base",
      "Add sliced carrots",
      "Add water and simmer until tender",
      "Season to taste",
    ],
  },

  // Tibbs (Sautéed Dishes)
  "Siga Tibbs": {
    title: "Siga Tibbs (Sautéed Beef)",
    category: "Tibbs",
    cookTime: "30 mins",
    servings: 4,
    image: "./images/siga-tibbs.jpg",
    description: "Ethiopian-style sautéed beef with aromatic spices.",
    requiredIngredients: [
      "beef",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "rosemary",
    ],
    optionalIngredients: [],
    instructions: [
      "Heat oil in a pan",
      "Add beef cubes and sear on all sides",
      "Add onion, garlic, and ginger",
      "Stir in berbere and spices",
      "Cook until beef is done and flavors meld",
    ],
  },
  "Mitmita Siga Tibbs": {
    title: "Mitmita Siga Tibbs (Spicy Beef Tibbs)",
    category: "Tibbs",
    cookTime: "30 mins",
    servings: 4,
    image: "./images/mitmita-siga-tibbs.jpg",
    description: "Extra spicy beef tibbs with mitmita spice blend.",
    requiredIngredients: [
      "beef",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "mitmita",
      "blackPepper",
      "rosemary",
    ],
    optionalIngredients: [],
    instructions: [
      "Follow Siga Tibbs preparation",
      "Add generous amount of mitmita near end of cooking",
      "Can also sprinkle additional mitmita when serving",
    ],
  },

  // Aterkilt (Mixed Vegetables)
  "Aterkilt Wot": {
    title: "Aterkilt Wot (Mixed Vegetable Stew)",
    category: "Aterkilt",
    cookTime: "40 mins",
    servings: 6,
    image: "./images/aterkilt-wot.jpg",
    description: "Traditional Ethiopian mixed vegetable stew.",
    requiredIngredients: [
      "potato",
      "carrot",
      "cabbage",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Sauté onion until soft",
      "Add garlic and ginger",
      "Add turmeric, cumin, and black pepper",
      "Add vegetables and water",
      "Simmer until vegetables are tender",
    ],
  },

  // Add more recipes
  "Ye'Doro Alicha Wot": {
    title: "Ye'Doro Alicha Wot (Mild Chicken Stew)",
    category: "Alicha Wot",
    cookTime: "45 mins",
    servings: 4,
    image: "./images/yedoro-alicha-wot.jpg",
    description:
      "Mild chicken stew seasoned with turmeric and aromatic spices.",
    requiredIngredients: [
      "chicken",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Sauté onions until soft",
      "Add garlic and ginger",
      "Add turmeric, cumin, and black pepper",
      "Add chicken pieces and brown lightly",
      "Add water and simmer until chicken is tender (30-45 min)",
      "Season with salt",
    ],
  },
  "Ye'Siga Alicha Wot": {
    title: "Ye'Siga Alicha Wot (Mild Beef Stew)",
    category: "Alicha Wot",
    cookTime: "2.5 hours",
    servings: 6,
    image: "./images/yesiga-alicha-wot.jpg",
    description: "Mild beef stew with turmeric and aromatic spices.",
    requiredIngredients: [
      "beef",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Follow same preparation as other Alicha Wot",
      "Simmer until beef is very tender (1.5-2.5 hours)",
    ],
  },
  "YeTomato Key Wot": {
    title: "YeTomato Key Wot (Red Tomato Stew)",
    category: "Vegetarian",
    cookTime: "30 mins",
    servings: 4,
    image: "./images/yetomato-key-wot.jpg",
    description: "Spicy tomato stew in berbere sauce.",
    requiredIngredients: [
      "tomato",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "cumin",
    ],
    optionalIngredients: [],
    instructions: [
      "Prepare wot base",
      "Add diced tomatoes",
      "Simmer for 15-20 minutes until tomatoes break down",
      "Season to taste",
    ],
  },
  "Gomen Wot": {
    title: "Gomen Wot (Spinach Stew)",
    category: "Vegetarian",
    cookTime: "25 mins",
    servings: 4,
    image: "./images/gomen-wot.jpg",
    description: "Traditional Ethiopian spinach stew.",
    requiredIngredients: [
      "spinach",
      "onion",
      "garlic",
      "ginger",
      "blackPepper",
    ],
    optionalIngredients: ["turmeric"],
    instructions: [
      "Sauté onion until soft",
      "Add garlic and ginger",
      "Add chopped spinach and cook until wilted",
      "Add water, black pepper, and turmeric if using",
      "Simmer briefly until done",
    ],
  },
  "Kosta Wot": {
    title: "Kosta Wot (Cabbage Stew)",
    category: "Vegetarian",
    cookTime: "35 mins",
    servings: 4,
    image: "./images/kosta-wot.jpg",
    description:
      "Ethiopian cabbage stew, available in both spicy and mild versions.",
    requiredIngredients: [
      "cabbage",
      "onion",
      "garlic",
      "ginger",
      "blackPepper",
    ],
    optionalIngredients: ["berbere", "turmeric"],
    instructions: [
      "Sauté onion until soft",
      "Add garlic and ginger",
      "Add chopped cabbage",
      "Add spices (berbere for spicy, turmeric for mild)",
      "Add water and simmer until tender-crisp",
    ],
  },
  "YeBeg Tibbs": {
    title: "YeBeg Tibbs (Sautéed Lamb)",
    category: "Tibbs",
    cookTime: "30 mins",
    servings: 4,
    image: "./images/yebeg-tibbs.jpg",
    description: "Ethiopian-style sautéed lamb with aromatic spices.",
    requiredIngredients: [
      "lamb",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "rosemary",
    ],
    optionalIngredients: [],
    instructions: [
      "Heat oil in a pan",
      "Add lamb pieces and sear on all sides",
      "Add onion, garlic, and ginger",
      "Stir in berbere and spices",
      "Cook until lamb is done and flavors meld",
    ],
  },
  "Ye'Fessas Tibbs": {
    title: "Ye'Fessas Tibbs (Sautéed Goat)",
    category: "Tibbs",
    cookTime: "40 mins",
    servings: 4,
    image: "./images/yefessas-tibbs.jpg",
    description: "Ethiopian-style sautéed goat with aromatic spices.",
    requiredIngredients: [
      "goat",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "rosemary",
    ],
    optionalIngredients: [],
    instructions: [
      "Follow general tibbs preparation",
      "Cook slightly longer than lamb until goat is tender",
    ],
  },
  "Doro Tibbs": {
    title: "Doro Tibbs (Sautéed Chicken)",
    category: "Tibbs",
    cookTime: "25 mins",
    servings: 4,
    image: "./images/doro-tibbs.jpg",
    description: "Ethiopian-style sautéed chicken with aromatic spices.",
    requiredIngredients: [
      "chicken",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
      "rosemary",
    ],
    optionalIngredients: [],
    instructions: [
      "Follow general tibbs preparation",
      "Cook until chicken is done but still juicy",
    ],
  },
  "Asa Tibbs": {
    title: "Asa Tibbs (Sautéed Fish)",
    category: "Tibbs",
    cookTime: "20 mins",
    servings: 4,
    image: "./images/asa-tibbs.jpg",
    description: "Ethiopian-style sautéed fish with mild spices.",
    requiredIngredients: [
      "fish",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Follow general tibbs preparation",
      "Be gentle with fish to prevent breaking",
      "Cook just until fish is done",
    ],
  },
  Dulet: {
    title: "Dulet (Minced Meat Tibbs)",
    category: "Tibbs",
    cookTime: "25 mins",
    servings: 4,
    image: "./images/dulet.jpg",
    description: "Spicy minced meat dish with mitmita and berbere.",
    requiredIngredients: [
      "beef",
      "onion",
      "garlic",
      "ginger",
      "mitmita",
      "berbere",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Sauté minced meat until browned",
      "Drain excess fat",
      "Add finely chopped onion, garlic, ginger",
      "Stir in mitmita, berbere, and spices",
      "Cook until well combined and fragrant",
    ],
  },
  "Ye'Kosta Tibbs": {
    title: "Ye'Kosta Tibbs (Sautéed Cabbage with Meat)",
    category: "Mixed Tibbs",
    cookTime: "35 mins",
    servings: 4,
    image: "./images/yekosta-tibbs.jpg",
    description: "Sautéed cabbage with choice of meat and spices.",
    requiredIngredients: [
      "cabbage",
      "onion",
      "garlic",
      "ginger",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: ["beef", "lamb", "chicken"],
    instructions: [
      "If using meat, sauté until browned",
      "Add onion, garlic, ginger",
      "Add shredded cabbage and spices",
      "Sauté until cabbage is tender-crisp",
    ],
  },
  "Ye'Dinich Tibbs": {
    title: "Ye'Dinich Tibbs (Sautéed Potato with Meat)",
    category: "Mixed Tibbs",
    cookTime: "40 mins",
    servings: 4,
    image: "./images/yedinich-tibbs.jpg",
    description: "Sautéed potatoes with choice of meat and spices.",
    requiredIngredients: [
      "potato",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "blackPepper",
    ],
    optionalIngredients: ["beef", "lamb", "chicken"],
    instructions: [
      "If using meat, sauté until browned",
      "Add onion, garlic, ginger",
      "Add cubed potatoes",
      "Add spices and cook until potatoes are tender",
    ],
  },
  "Misir Wot": {
    title: "Misir Wot (Red Lentil Stew)",
    category: "Vegetarian",
    cookTime: "45 mins",
    servings: 6,
    image: "./images/misir-wot.jpg",
    description:
      "A hearty Ethiopian red lentil stew seasoned with berbere and aromatic spices.",
    requiredIngredients: [
      "lentils",
      "onion",
      "garlic",
      "ginger",
      "berbere",
      "turmeric",
      "cumin",
      "blackPepper",
    ],
    optionalIngredients: [],
    instructions: [
      "Rinse lentils thoroughly",
      "Dry-sauté chopped onions until golden",
      "Add oil, minced garlic, grated ginger and sauté",
      "Stir in berbere and cook for 5-7 minutes",
      "Add rinsed lentils and hot water",
      "Simmer covered for 30-40 minutes until creamy",
      "Stir in turmeric, cumin, and black pepper",
      "Serve hot with injera",
    ],
  },
  "Shiro Wot": {
    title: "Shiro Wot (Chickpea Flour Stew)",
    category: "Vegetarian",
    cookTime: "35 mins",
    servings: 6,
    image: "./images/shiro-wot.jpg",
    description:
      "A smooth, creamy Ethiopian stew made from ground chickpea flour.",
    requiredIngredients: ["shiro", "onion", "garlic", "ginger", "blackPepper"],
    optionalIngredients: ["tomato", "rosemary"],
    instructions: [
      "Dry-sauté chopped onions until golden",
      "Add oil, minced garlic, grated ginger and sauté",
      "In separate bowl, whisk shiro powder with hot water to make smooth paste",
      "Gradually whisk shiro paste into onion mixture",
      "Slowly add remaining hot water, whisking constantly",
      "Simmer covered for 20-30 minutes, stirring frequently",
      "Add optional ingredients in last 10 minutes if using",
      "Season with black pepper and serve hot with injera",
    ],
  },
};

function findMatchingRecipes(availableIngredients) {
  const matches = [];

  for (const [recipeName, recipe] of Object.entries(ethiopianRecipes)) {
    const requiredCount = recipe.requiredIngredients.filter((ingredient) =>
      availableIngredients.includes(ingredient)
    ).length;

    const optionalCount = recipe.optionalIngredients.filter((ingredient) =>
      availableIngredients.includes(ingredient)
    ).length;

    const requiredPercentage =
      (requiredCount / recipe.requiredIngredients.length) * 100;
    const optionalBonus =
      recipe.optionalIngredients.length > 0
        ? (optionalCount / recipe.optionalIngredients.length) * 10
        : 0;

    const totalMatch = Math.min(
      100,
      Math.round(requiredPercentage + optionalBonus)
    );

    const missingIngredients = recipe.requiredIngredients.filter(
      (ingredient) => !availableIngredients.includes(ingredient)
    );

    if (totalMatch > 0) {
      matches.push({
        ...recipe,
        matchPercentage: totalMatch,
        missingIngredients: missingIngredients,
      });
    }
  }

  return matches.sort((a, b) => b.matchPercentage - a.matchPercentage);
}

function getRecipesByCategory(category) {
  return Object.values(ethiopianRecipes).filter(
    (recipe) => recipe.category === category
  );
}

function getAllCategories() {
  return [
    ...new Set(
      Object.values(ethiopianRecipes).map((recipe) => recipe.category)
    ),
  ];
}

function getRecipeByName(recipeName) {
  return ethiopianRecipes[recipeName] || null;
}

function getAllRecipes() {
  return Object.values(ethiopianRecipes);
}

export {
  ethiopianRecipes,
  findMatchingRecipes,
  getRecipeByName,
  getAllRecipes,
  getRecipesByCategory,
  getAllCategories,
};
