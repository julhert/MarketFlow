import { create } from 'twrnc';

const tw = create({
  theme: {
    extend: {
      colors: {
        'btn-buy': '#E98800',
        'brand-blue-200': '#274472',
        'brand-blue-400': '#0E1A2B',
        'main-black': '#000000',
      },
    },
  },
});

export default tw;