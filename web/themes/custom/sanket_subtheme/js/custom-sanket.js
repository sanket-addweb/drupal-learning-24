console.log('hello');

// .view-test-rendom-data .views-field-title a

// // Select all elements matching the selector
// var elements = document.querySelectorAll('.view-test-rendom-data .views-field-title a');
// console.log(elements);
// // Convert the NodeList to an array for easy manipulation
// var elementsArray = Array.from(elements);
// console.log(elementsArray);

// // Shuffle the array using the Fisher-Yates algorithm
// for (var i = elementsArray.length - 1; i > 0; i--) {
//     var j = Math.floor(Math.random() * (i + 1));
//     var temp = elementsArray[i];
//     elementsArray[i] = elementsArray[j];
//     elementsArray[j] = temp;
// }

// // Append the shuffled elements back to their parent container
// var container = document.querySelector('.view-test-rendom-data');
// elementsArray.forEach(function(element) {
//     container.appendChild(element.parentElement);
// });

// (function ($) {
//     Drupal.behaviors.randomizeLinks = {
//       attach: function (context, settings) {
//         // Select all elements matching the selector within the context
//         var elements = $(context).find('.view-test-rendom-data .views-field-title a');
  
//         // Shuffle the elements
//         elements.sort(function() { return 0.5 - Math.random(); });
  
//         // Append the shuffled elements back to their parent container
//         var container = $('.view-test-rendom-data');
//         container.empty(); // Clear existing content
//         elements.each(function() {
//           container.append($(this).parent()); // Assuming the parent contains the link
//         });
//       }
//     };
//   })(jQuery);

(function ($) {
    Drupal.behaviors.randomizeLinks = {
        attach: function (context, settings) {
        // Select all elements matching the selector
        var elements = context.querySelectorAll('.view-test-rendom-data .views-field-title a');

        // Convert the NodeList to an array
        var elementsArray = Array.from(elements);

        // Shuffle the array using the Fisher-Yates algorithm
        for (var i = elementsArray.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = elementsArray[i];
            elementsArray[i] = elementsArray[j];
            elementsArray[j] = temp;
        }

        // Append the shuffled elements back to their parent container
        var container = context.querySelector('.view-test-rendom-data');
        elementsArray.forEach(function (element) {
            container.appendChild(element.parentElement);
        });
        }
    };
})(jQuery);
  