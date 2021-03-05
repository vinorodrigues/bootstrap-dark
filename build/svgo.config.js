module.exports = {
  plugins: [
    {
      name: 'removeStyleElement',
      active: false
    },
    {
      name: 'cleanupIDs',
      active: false
    },
    {
      name: 'inlineStyles',
      active: false
    },
    {
      name: 'convertStyleToAttrs',
      active: false
    },
    {
      name: 'removeScriptElement',
      active: false
    }
    'removeDoctype',
    'removeXMLProcInst',
    'removeComments',
    'removeMetadata',
    'removeTitle',
    'removeDesc',
    'removeEditorsNSData',
    'removeEmptyAttrs',
    'removeHiddenElems',
    'removeEmptyText',
    'removeEmptyContainers',
    'removeViewBox',
    'removeUselessStrokeAndFill',
    'minifyStyles'
  ]
}
