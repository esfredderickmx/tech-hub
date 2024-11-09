import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/robsontenorio/mary/src/View/Components/**/*.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  daisyui: {
    themes: [
      {
        light: {
          'primary': '#0b3a61',    // Azul ligeramente más oscuro para mayor contraste
          'secondary': '#f4e1a1',  // Un tono crema un poco más fuerte para visibilidad
          'accent': '#f8c04f',     // Un amarillo cálido para los acentos
          'neutral': '#e0e0e0',    // Gris claro para un contraste suave
          'base-100': '#ffffff',   // Fondo blanco para el tema claro
          'base-200': '#f0f0f0',   // Fondo suave para cards y componentes
          'base-300': '#d9d9d9',   // Fondo intermedio para divisores
          'info': '#4fa3d1',       // Azul suave para información
          'success': '#2c9f75',    // Verde más oscuro para éxito
          'warning': '#f3b52e',    // Dorado para advertencias
          'error': '#f56c6c',       // Rojo para errores
        },
      },
      {
        dark: {
          'primary': '#0b3a61',    // Azul ligeramente más oscuro para mayor contraste
          'secondary': '#f4e1a1',  // Un crema más saturado para mayor visibilidad
          'accent': '#f8c04f',     // Amarillo cálido para los acentos
          'neutral': '#212121',    // Gris oscuro para el fondo neutro
          'base-100': '#1a1a1a',   // Fondo oscuro para el tema oscuro
          'base-200': '#2c2c2c',   // Fondo más oscuro para cards y componentes
          'base-300': '#333333',   // Fondo intermedio para divisores y bordes
          'info': '#4fa3d1',       // Azul suave para la información
          'success': '#2c9f75',    // Verde más oscuro para éxito
          'warning': '#f3b52e',    // Dorado para advertencias
          'error': '#f56c6c',       // Rojo suave para errores
        },
      },

    ],
  },
  plugins: [
    require('daisyui'),
  ],
};
