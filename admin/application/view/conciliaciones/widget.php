<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://syncfy.com/widget/v2/widget.css" />
    <title>Syncfy Widget Quickstart</title>
  </head>
  <body>
    <div id="widget"></div>
    <script type="text/javascript" src="https://syncfy.com/widget/v2/widget.js"></script>
    <script>
      var params = {
        // Set up the token you created in the Quickstart:
        token: 'c6a0b09a672d3666971d3de6c259c534e1643420e6173d4b7100a0510e163dab',
        config: {
          // Set up the language to use:
          locale: 'es',
          entrypoint: {
            // Set up the country to start:
            country: 'MX',
            // Set up the site organization type to start:
            siteOrganizationType: '56cf4f5b784806cf028b4568',
          },
          navigation: {
            displayStatusInToast: true,
          },
        },
      };
      var syncWidget = new SyncWidget(params);
      syncWidget.open();
    </script>
  </body>
</html>