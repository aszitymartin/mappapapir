import _extends from "@babel/runtime/helpers/esm/extends";
import _objectWithoutPropertiesLoose from "@babel/runtime/helpers/esm/objectWithoutPropertiesLoose";
const _excluded = ["action", "children", "component", "components", "componentsProps", "disabled", "focusableWhenDisabled", "onBlur", "onClick", "onFocus", "onFocusVisible", "onKeyDown", "onKeyUp", "onMouseLeave"];
import * as React from 'react';
import PropTypes from 'prop-types';
import composeClasses from '../composeClasses';
import { getButtonUnstyledUtilityClass } from './buttonUnstyledClasses';
import useButton from './useButton';
import { useSlotProps } from '../utils';
import { jsx as _jsx } from "react/jsx-runtime";

const useUtilityClasses = ownerState => {
  const {
    active,
    disabled,
    focusVisible
  } = ownerState;
  const slots = {
    root: ['root', disabled && 'disabled', focusVisible && 'focusVisible', active && 'active']
  };
  return composeClasses(slots, getButtonUnstyledUtilityClass, {});
};
/**
 * The foundation for building custom-styled buttons.
 *
 * Demos:
 *
 * - [Unstyled button](https://mui.com/base/react-button/)
 *
 * API:
 *
 * - [ButtonUnstyled API](https://mui.com/base/api/button-unstyled/)
 */


const ButtonUnstyled = /*#__PURE__*/React.forwardRef(function ButtonUnstyled(props, forwardedRef) {
  const {
    action,
    children,
    component,
    components = {},
    componentsProps = {},
    focusableWhenDisabled = false
  } = props,
        other = _objectWithoutPropertiesLoose(props, _excluded);

  const buttonRef = React.useRef();
  const {
    active,
    focusVisible,
    setFocusVisible,
    getRootProps
  } = useButton(_extends({}, props, {
    focusableWhenDisabled
  }));
  React.useImperativeHandle(action, () => ({
    focusVisible: () => {
      setFocusVisible(true);
      buttonRef.current.focus();
    }
  }), [setFocusVisible]);

  const ownerState = _extends({}, props, {
    active,
    focusableWhenDisabled,
    focusVisible
  });

  const classes = useUtilityClasses(ownerState);
  const Root = component ?? components.Root ?? 'button';
  const rootProps = useSlotProps({
    elementType: Root,
    getSlotProps: getRootProps,
    externalForwardedProps: other,
    externalSlotProps: componentsProps.root,
    additionalProps: {
      ref: forwardedRef
    },
    ownerState,
    className: classes.root
  });
  return /*#__PURE__*/_jsx(Root, _extends({}, rootProps, {
    children: children
  }));
});
process.env.NODE_ENV !== "production" ? ButtonUnstyled.propTypes
/* remove-proptypes */
= {
  // ----------------------------- Warning --------------------------------
  // | These PropTypes are generated from the TypeScript type definitions |
  // |     To update them edit TypeScript types and run "yarn proptypes"  |
  // ----------------------------------------------------------------------

  /**
   * A ref for imperative actions. It currently only supports `focusVisible()` action.
   */
  action: PropTypes.oneOfType([PropTypes.func, PropTypes.shape({
    current: PropTypes.shape({
      focusVisible: PropTypes.func.isRequired
    })
  })]),

  /**
   * @ignore
   */
  children: PropTypes.node,

  /**
   * The component used for the root node.
   * Either a string to use a HTML element or a component.
   */
  component: PropTypes.elementType,

  /**
   * The components used for each slot inside the Button.
   * Either a string to use a HTML element or a component.
   * @default {}
   */
  components: PropTypes.shape({
    Root: PropTypes.elementType
  }),

  /**
   * The props used for each slot inside the Button.
   * @default {}
   */
  componentsProps: PropTypes.shape({
    root: PropTypes.oneOfType([PropTypes.func, PropTypes.object])
  }),

  /**
   * If `true`, the component is disabled.
   * @default false
   */
  disabled: PropTypes.bool,

  /**
   * If `true`, allows a disabled button to receive focus.
   * @default false
   */
  focusableWhenDisabled: PropTypes.bool,

  /**
   * @ignore
   */
  onBlur: PropTypes.func,

  /**
   * @ignore
   */
  onClick: PropTypes.func,

  /**
   * @ignore
   */
  onFocus: PropTypes.func,

  /**
   * @ignore
   */
  onFocusVisible: PropTypes.func,

  /**
   * @ignore
   */
  onKeyDown: PropTypes.func,

  /**
   * @ignore
   */
  onKeyUp: PropTypes.func,

  /**
   * @ignore
   */
  onMouseLeave: PropTypes.func
} : void 0;
export default ButtonUnstyled;