import _extends from "@babel/runtime/helpers/esm/extends";
import _slicedToArray from "@babel/runtime/helpers/esm/slicedToArray";
import _objectWithoutProperties from "@babel/runtime/helpers/esm/objectWithoutProperties";
import * as React from 'react';
import PropTypes from 'prop-types';
import { unstable_useControlled as useControlled } from '@mui/utils';
import FormControlUnstyledContext from './FormControlUnstyledContext';
import { getFormControlUnstyledUtilityClass } from './formControlUnstyledClasses';
import { useSlotProps } from '../utils';
import composeClasses from '../composeClasses';
import { jsx as _jsx } from "react/jsx-runtime";

function hasValue(value) {
  return value != null && !(Array.isArray(value) && value.length === 0) && value !== '';
}

function useUtilityClasses(ownerState) {
  var disabled = ownerState.disabled,
      error = ownerState.error,
      filled = ownerState.filled,
      focused = ownerState.focused,
      required = ownerState.required;
  var slots = {
    root: ['root', disabled && 'disabled', focused && 'focused', error && 'error', filled && 'filled', required && 'required']
  };
  return composeClasses(slots, getFormControlUnstyledUtilityClass, {});
}
/**
 * Provides context such as filled/focused/error/required for form inputs.
 * Relying on the context provides high flexibility and ensures that the state always stays
 * consistent across the children of the `FormControl`.
 * This context is used by the following components:
 *
 * *   FormLabel
 * *   FormHelperText
 * *   Input
 * *   InputLabel
 *
 * You can find one composition example below and more going to [the demos](https://mui.com/material-ui/react-text-field/#components).
 *
 * ```jsx
 * <FormControl>
 *   <InputLabel htmlFor="my-input">Email address</InputLabel>
 *   <Input id="my-input" aria-describedby="my-helper-text" />
 *   <FormHelperText id="my-helper-text">We'll never share your email.</FormHelperText>
 * </FormControl>
 * ```
 *
 * ⚠️ Only one `Input` can be used within a FormControl because it create visual inconsistencies.
 * For instance, only one input can be focused at the same time, the state shouldn't be shared.
 *
 * Demos:
 *
 * - [Unstyled form control](https://mui.com/base/react-form-control/)
 *
 * API:
 *
 * - [FormControlUnstyled API](https://mui.com/base/api/form-control-unstyled/)
 */


var FormControlUnstyled = /*#__PURE__*/React.forwardRef(function FormControlUnstyled(props, ref) {
  var _ref;

  var defaultValue = props.defaultValue,
      children = props.children,
      component = props.component,
      _props$components = props.components,
      components = _props$components === void 0 ? {} : _props$components,
      _props$componentsProp = props.componentsProps,
      componentsProps = _props$componentsProp === void 0 ? {} : _props$componentsProp,
      _props$disabled = props.disabled,
      disabled = _props$disabled === void 0 ? false : _props$disabled,
      _props$error = props.error,
      error = _props$error === void 0 ? false : _props$error,
      onChange = props.onChange,
      _props$required = props.required,
      required = _props$required === void 0 ? false : _props$required,
      incomingValue = props.value,
      other = _objectWithoutProperties(props, ["defaultValue", "children", "component", "components", "componentsProps", "disabled", "error", "onChange", "required", "value"]);

  var _useControlled = useControlled({
    controlled: incomingValue,
    default: defaultValue,
    name: 'FormControl',
    state: 'value'
  }),
      _useControlled2 = _slicedToArray(_useControlled, 2),
      value = _useControlled2[0],
      setValue = _useControlled2[1];

  var filled = hasValue(value);

  var _React$useState = React.useState(false),
      focused = _React$useState[0],
      setFocused = _React$useState[1];

  if (disabled && focused) {
    setFocused(false);
  }

  var ownerState = _extends({}, props, {
    disabled: disabled,
    error: error,
    filled: filled,
    focused: focused,
    required: required
  });

  var handleChange = function handleChange(event) {
    setValue(event.target.value);
    onChange == null ? void 0 : onChange(event);
  };

  var childContext = {
    disabled: disabled,
    error: error,
    filled: filled,
    focused: focused,
    onBlur: function onBlur() {
      setFocused(false);
    },
    onChange: handleChange,
    onFocus: function onFocus() {
      setFocused(true);
    },
    required: required,
    value: value != null ? value : ''
  };
  var classes = useUtilityClasses(ownerState);

  var renderChildren = function renderChildren() {
    if (typeof children === 'function') {
      return children(childContext);
    }

    return children;
  };

  var Root = (_ref = component != null ? component : components.Root) != null ? _ref : 'div';
  var rootProps = useSlotProps({
    elementType: Root,
    externalSlotProps: componentsProps.root,
    externalForwardedProps: other,
    additionalProps: {
      ref: ref,
      children: renderChildren()
    },
    ownerState: ownerState,
    className: classes.root
  });
  return /*#__PURE__*/_jsx(FormControlUnstyledContext.Provider, {
    value: childContext,
    children: /*#__PURE__*/_jsx(Root, _extends({}, rootProps))
  });
});
process.env.NODE_ENV !== "production" ? FormControlUnstyled.propTypes
/* remove-proptypes */
= {
  // ----------------------------- Warning --------------------------------
  // | These PropTypes are generated from the TypeScript type definitions |
  // |     To update them edit TypeScript types and run "yarn proptypes"  |
  // ----------------------------------------------------------------------

  /**
   * The content of the component.
   */
  children: PropTypes
  /* @typescript-to-proptypes-ignore */
  .oneOfType([PropTypes.node, PropTypes.func]),

  /**
   * The component used for the root node.
   * Either a string to use a HTML element or a component.
   */
  component: PropTypes.elementType,

  /**
   * The components used for each slot inside the FormControl.
   * Either a string to use a HTML element or a component.
   * @default {}
   */
  components: PropTypes.shape({
    Root: PropTypes.elementType
  }),

  /**
   * @ignore
   */
  componentsProps: PropTypes.shape({
    root: PropTypes.oneOfType([PropTypes.func, PropTypes.object])
  }),

  /**
   * @ignore
   */
  defaultValue: PropTypes.any,

  /**
   * If `true`, the label, input and helper text should be displayed in a disabled state.
   * @default false
   */
  disabled: PropTypes.bool,

  /**
   * If `true`, the label is displayed in an error state.
   * @default false
   */
  error: PropTypes.bool,

  /**
   * @ignore
   */
  onChange: PropTypes.func,

  /**
   * If `true`, the label will indicate that the `input` is required.
   * @default false
   */
  required: PropTypes.bool,

  /**
   * @ignore
   */
  value: PropTypes.any
} : void 0;
export default FormControlUnstyled;