# Drupal 8 custom image effect (Colorize filter)

Because finding a good example of implementation of custom image filter for Drupal 8 is almost impossible, after managing to do it I decided to share it with you!

The Drupal 8 GD image effects are primarly based on the PHP `imagefilter` function, but natively, only a few effects are available (resize, scale, crop, rotate, desaturate and convert) even if `imagefilter` can do much more. This example illustrates how to put in place of a simple colorize effect through a very simple module.

In order to do that, there are two key files:

  - `src/Plugin/ImageToolkit/Operation/gd/Colorize.php`: The instructions defining how to call `imagefilter` (the arguments)
  - `src/Plugin/ImageEffect/CustomColorizeImageEffect.php`: The effect itself (its name, attributes and how to display the form and how to map the effect's arguments)

Hope this helps.
