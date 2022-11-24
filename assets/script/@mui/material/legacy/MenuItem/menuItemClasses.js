import { generateUtilityClass, generateUtilityClasses } from '@mui/base';
export function getMenuItemUtilityClass(slot) {
  return generateUtilityClass('MuiMenuItem', slot);
}
var menuItemClasses = generateUtilityClasses('MuiMenuItem', ['root', 'focusVisible', 'dense', 'disabled', 'divider', 'gutters', 'selected']);
export default menuItemClasses;