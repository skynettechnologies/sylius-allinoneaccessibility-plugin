document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('loader');
    // Function to show loader
    function showLoader() {
        loader.style.display = 'flex';
    }
    // Function to hide loader
    function hideLoader() {
        loader.style.display = 'none';
    }
    // Function to populate form fields dynamically from fetched settings
    function setWidgetData(widgetPosition, widgetColor, iconType, iconSize, widgetSize, widgetIconSizeCustom, is_widget_custom_size, is_widget_custom_position, widgetPositionTop, widgetPositionBottom, widgetPositionLeft, widgetPositionRight) {
      if (widgetColor) {
        const colorInput = document.getElementById("color");
        colorInput.value = widgetColor;
      }
      if (widgetPosition) {
        const positionRadio = document.querySelector(`.aioa-position[value="${widgetPosition}"]`);
        if (positionRadio) {
          positionRadio.checked = true;
        }
      }
      if (iconType) {
        const iconRadio = document.querySelector(`.icon_type[value="${iconType}"]`);
        if (iconRadio) {
          iconRadio.checked = true;
          const iconImg = "https://www.skynettechnologies.com/sites/default/files/" + iconType + ".svg";
          $(".iconimg").attr("src", iconImg);
        }
      }
      if (iconSize) {
        const iconSizeRadio = document.querySelector(`.aioa-iconsize[value="${iconSize}"]`);
        if (iconSizeRadio) {
          iconSizeRadio.checked = true;
        }
      }
      if (widgetSize) {
        const widgetSizeRadio = document.querySelector(`input[name="widget_size"][value="${widgetSize}"]`);
        if (widgetSizeRadio) {
          widgetSizeRadio.checked = true;
        }
      }

      if (widgetIconSizeCustom !== undefined && widgetIconSizeCustom !== "") {
        const iconSizeCustomInput = document.getElementById("widget_icon_size_custom");
        if (iconSizeCustomInput) {
          iconSizeCustomInput.value = widgetIconSizeCustom; // Set the custom size
        }
      }

      const selectedCustomPosition = document.querySelector('input[name="is_widget_custom_position"]:checked')?.value;

      if (selectedCustomPosition !== null && selectedCustomPosition !== undefined) {
        // Set the radio buttons
        document.querySelectorAll('input[name="is_widget_custom_position"]').forEach(input => {
          input.checked = input.value === selectedCustomPosition;
        });

        // Show/hide related fieldsets
        const customPos1 = document.querySelector('.edit-is-widget-custom-position-1');
        const customPos0 = document.querySelector('.edit-is-widget-custom-position-0');

        if (selectedCustomPosition === "1") {
          customPos1?.classList.remove("hide");
          customPos1?.style.setProperty("display", "block");
          customPos0?.classList.add("hide");
          customPos0?.style.setProperty("display", "none");
        } else {
          customPos0?.classList.remove("hide");
          customPos0?.style.setProperty("display", "block");
          customPos1?.classList.add("hide");
          customPos1?.style.setProperty("display", "none");
        }
      }

// Handle widget custom size
      if (typeof is_widget_custom_size !== "undefined") {
        const selectedCustomSize = String(is_widget_custom_size);

        document.querySelectorAll('input[name="is_widget_custom_size"]').forEach(input => {
          input.checked = input.value === selectedCustomSize;
        });

        // Show/hide related fieldsets
        const customSize1 = document.querySelector('.edit-is-widget-custom-size-1');
        const customSize0 = document.querySelector('.edit-is-widget-custom-size-0');

        if (selectedCustomSize === "1") {
          customSize1?.classList.remove("hide");
          customSize1?.style.setProperty("display", "block");
          customSize0?.classList.add("hide");
          customSize0?.style.setProperty("display", "none");
        } else {
          customSize0?.classList.remove("hide");
          customSize0?.style.setProperty("display", "block");
          customSize1?.classList.add("hide");
          customSize1?.style.setProperty("display", "none");
        }
      }

      if (widgetPositionLeft !== undefined && widgetPositionLeft !== "") {
        const positionHorizontal = document.querySelector('[name="aioa_custom_position_horizontal"]');
        if (positionHorizontal) {
          positionHorizontal.value = widgetPositionLeft;
        }

        const positionHorizontalType = document.querySelector('[name="aioa_custom_position_horizontal_type"]');
        if (positionHorizontalType) {
          positionHorizontalType.value = "left";
        }
      }

      if (widgetPositionRight !== undefined && widgetPositionRight !== "") {
        const positionHorizontal = document.querySelector('[name="aioa_custom_position_horizontal"]');
        if (positionHorizontal) {
          positionHorizontal.value = widgetPositionRight;
        }

        const positionHorizontalType = document.querySelector('[name="aioa_custom_position_horizontal_type"]');
        if (positionHorizontalType) {
          positionHorizontalType.value = "right";
        }
      }

      // Set Vertical Position: Top / Bottom
      if (widgetPositionTop !== undefined && widgetPositionTop !== "") {
        const positionVerticalType = document.querySelector('[name="aioa_custom_position_vertical_type"]');
        if (positionVerticalType) {
          positionVerticalType.value = "top";
        }
        const widgetPositionBottom = document.getElementById('widget_position_bottom');
        if (widgetPositionBottom) widgetPositionBottom.value = "";
      }

      if (widgetPositionBottom !== undefined && widgetPositionBottom !== "") {
        const positionVerticalType = document.querySelector('[name="aioa_custom_position_vertical_type"]');
        if (positionVerticalType) {
          positionVerticalType.value = "bottom";
        }
        const widgetPositionTop = document.getElementById('widget_position_top');
        if (widgetPositionTop) widgetPositionTop.value = "";
      }

      // Select correct option for Horizontal Position (Left or Right)
      if (widgetPositionLeft || widgetPositionRight) {
        const positionHorizontalTypeSelect = document.querySelector('[name="aioa_custom_position_horizontal_type"]');
        if (positionHorizontalTypeSelect) {
          const options = positionHorizontalTypeSelect.querySelectorAll('option');
          options.forEach(option => {
            if (widgetPositionLeft && option.value === "left") {
              option.selected = true;
            }
            if (widgetPositionRight && option.value === "right") {
              option.selected = true;
            }
          });
        }
      }

      // Select correct option for Vertical Position (Top or Bottom)
      if (widgetPositionTop || widgetPositionBottom) {
        const positionVerticalTypeSelect = document.querySelector('[name="aioa_custom_position_vertical_type"]');
        if (positionVerticalTypeSelect) {
          const options = positionVerticalTypeSelect.querySelectorAll('option');
          options.forEach(option => {
            if (widgetPositionTop && option.value === "top") {
              option.selected = true;
            }
            if (widgetPositionBottom && option.value === "bottom") {
              option.selected = true;
            }
          });
        }
      }
      const positionHorizontalTextBox = document.querySelector('[name="aioa_custom_position_horizontal"]');
      if (positionHorizontalTextBox) {
        const positionHorizontalTextBox = document.querySelector('[name="aioa_custom_position_horizontal"]');
        var custom_position_horizontal_type = document.querySelector('select[name="aioa_custom_position_horizontal_type"]').value;
        if(custom_position_horizontal_type=='left'){
          positionHorizontalTextBox.value = widgetPositionLeft;
        }
        else if(custom_position_horizontal_type=='right') {
          positionHorizontalTextBox.value = widgetPositionRight;
        }
      }

      const positionVerticalTextBox = document.querySelector('[name="aioa_custom_position_vertical"]');
      if (positionVerticalTextBox) {
        const positionVerticalTextBox = document.querySelector('[name="aioa_custom_position_vertical"]');
        var custom_position_vertical_type = document.querySelector('select[name="aioa_custom_position_vertical_type"]').value;
        if(custom_position_vertical_type=='bottom'){
          positionVerticalTextBox.value = widgetPositionBottom;
        }
        else if(custom_position_vertical_type=='top') {
          positionVerticalTextBox.value = widgetPositionTop;
        }
      }

    }

    const defaultValues = {
        widgetPosition: "bottom_right",
        widgetColor: "#420083",
        iconType: "aioa-icon-type-1",
        iconSize: "aioa-medium-icon",
        widgetSize: "",
        widgetIconSizeCustom: "",
        is_widget_custom_size: "0",
        is_widget_custom_position: "0",
        widgetPositionTop: "",
        widgetPositionBottom: "",
        widgetPositionLeft: "",
        widgetPositionRight: ""
    };
    const domainWithPort = window.location.host; // e.g. "127.0.0.1:8000"
    const domain_name = domainWithPort.split(':')[0]; // gets "127.0.0.1"
    console.log(domain_name);
    if (domain_name && domain_name !== '') {
        // Show loader before fetching data
        showLoader();
        // If domain_name is present, fetch from the external API
        const apiUrl = "https://ada.skynettechnologies.us/api/widget-settings";   // Fetch Widget Data from the Dashboard
        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                website_url: domain_name
            })
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json(); // Parse JSON response
            })
            .then((data) => {
                // Extract widget position and other settings from the API response
                const widgetPosition = data.Data?.widget_position || defaultValues.widgetPosition;
                const widgetColor = data.Data?.widget_color_code || defaultValues.widgetColor;
                const iconType = data.Data?.widget_icon_type || defaultValues.iconType;
                const iconSize = data.Data?.widget_icon_size || defaultValues.iconSize;
                const widgetSize = data.Data?.widget_size || defaultValues.widgetSize;
                const widgetIconSizeCustom = data.Data?.widget_icon_size_custom || defaultValues.widgetIconSizeCustom;
                const is_widget_custom_size = data.Data?.is_widget_custom_size || defaultValues.is_widget_custom_size;
                const is_widget_custom_position = data.Data?.is_widget_custom_position || defaultValues.is_widget_custom_position;
                const widgetPositionTop = data.Data?.widget_position_top ?? defaultValues.widgetPositionTop;
                const widgetPositionBottom = data.Data?.widget_position_bottom ?? defaultValues.widgetPositionBottom;
                const widgetPositionLeft = data.Data?.widget_position_left ?? defaultValues.widgetPositionLeft;
                const widgetPositionRight = data.Data?.widget_position_right ?? defaultValues.widgetPositionRight;
                setWidgetData(
                    widgetPosition,
                    widgetColor,
                    iconType,
                    iconSize,
                    widgetSize,
                    widgetIconSizeCustom,
                    is_widget_custom_size,
                    is_widget_custom_position,
                    widgetPositionTop,
                    widgetPositionBottom,
                    widgetPositionLeft,
                    widgetPositionRight
                );
                //console.log(data,widgetPositionTop,widgetPositionBottom,widgetPositionLeft,widgetPositionRight);
            })
            .catch((error) => {
                console.error("Error fetching widget position:", error);
            })
            .finally(() => {
                    // Hide loader after fetching data is complete (success or error)
                    hideLoader();
            });
        }
        else {
            // If domain_name is not valid, set default values
            setWidgetData(
                defaultValues.widgetPosition,
                defaultValues.widgetColor,
                defaultValues.iconType,
                defaultValues.iconSize,
                defaultValues.widgetSize,
                defaultValues.is_widget_custom_size,
                defaultValues.is_widget_custom_position,
                defaultValues.widgetIconSizeCustom,
                defaultValues.widgetPositionTop,
                defaultValues.widgetPositionBottom,
                defaultValues.widgetPositionLeft,
                defaultValues.widgetPositionRight
            );
        }
    // $('.colorpicker').on('input', function () {
    //     $('.colorint').val(this.value);
    // });
    // $('.colorint').on('input', function () {
    //     $('.colorpicker').val(this.value);
    // });

    $(".icon_type").change(function () {
        var icon_type = $(this).val(); // Get the selected icon type value
        var iconImg = "https://www.skynettechnologies.com/sites/default/files/" + icon_type + ".svg";
        $(".iconimg").attr("src", iconImg); // Update the icon image source
    });

    document.getElementById('form-module').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior
        // Collect form data
        document.getElementById('loader').style.display = 'flex';
        var color = document.getElementById("color").value;
        var positionVal = document.querySelector('.aioa-position:checked').value;
        var icon_typeVal = document.querySelector('.icon_type:checked').value;
        var icon_sizeVal = document.querySelector('.aioa-iconsize:checked').value;

        var custom_position_horizontal = document.querySelector('input[name="aioa_custom_position_horizontal"]').value;
        var custom_position_vertical = document.querySelector('input[name="aioa_custom_position_vertical"]').value;
        var custom_position_horizontal_type = document.querySelector('select[name="aioa_custom_position_horizontal_type"]').value;
        var custom_position_vertical_type = document.querySelector('select[name="aioa_custom_position_vertical_type"]').value;
        var widget_size = document.querySelector('.select-widget-size:checked').value;

        var widget_position_left=(custom_position_horizontal_type==="left")?custom_position_horizontal:"";
        var widget_position_right=(custom_position_horizontal_type==="right")?custom_position_horizontal:"";
        var widget_position_top=(custom_position_vertical_type==="top")?custom_position_vertical:"";
        var widget_position_bottom=(custom_position_vertical_type==="bottom")?custom_position_vertical:"";

        var is_widget_custom_position = document.querySelector('input[name="is_widget_custom_position"]:checked')?.value || '0';
        var is_widget_custom_size = document.querySelector('input[name="is_widget_custom_size"]:checked')?.value || '0';
        var widget_icon_size_custom = document.getElementById("widget_icon_size_custom") ? document.getElementById("widget_icon_size_custom").value : '';
        var user_name = document.getElementById("user_name").value;  // You could also dynamically set this from JS
        var email = document.getElementById("email").value;

        // console.log('Selected Horizontal (px):', widget_position_left);
        // console.log('Selected Vertical (px):', widget_position_right);
        // console.log('Selected Horizontal Value (px):', widget_position_top);
        // console.log('Selected Vertical Value (px):', widget_position_bottom);

        const domainWithPort = window.location.host; // e.g. "127.0.0.1:8000"
        const domain_name = domainWithPort.split(':')[0]; // gets "127.0.0.1"
        console.log(domain_name);
        var params = new URLSearchParams();
        params.append('u', domain_name);
        params.append('widget_position', positionVal);
        params.append('widget_color_code', color);
        params.append('widget_icon_type', icon_typeVal);
        params.append('widget_icon_size', icon_sizeVal);
        params.append('widget_position_left', widget_position_left);
        params.append('widget_position_top', widget_position_top);
        params.append('widget_position_right', widget_position_right);
        params.append('widget_position_bottom', widget_position_bottom);
        params.append('widget_size', widget_size);
        params.append('is_widget_custom_position', is_widget_custom_position);
        params.append('is_widget_custom_size', is_widget_custom_size);
        params.append('widget_icon_size_custom', widget_icon_size_custom);
        // Send the request using the fetch API to the external API
        const requestOptions = {
            method: "POST",
            body: params,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded' // Ensure the body is sent as URL-encoded
            },
            redirect: "follow"
        };
        fetch('https://ada.skynettechnologies.us/api/widget-setting-update-platform', requestOptions)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                if (result && result.status === 'success') {
                   // console.log('Response from external API:', result);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                // Hide the loader after the form is submitted
                document.getElementById('loader').style.display = 'none';
                alert("Widget Settings saved successfully!!!");
            });
    });

    const sizeOptions = document.querySelectorAll('input[name="icon_size"]');
    const sizeOptionsImg = document.querySelectorAll('input[name="icon_size"] + label img');
    const typeOptions = document.querySelectorAll('input[name="icon_type"]');

    sizeOptionsImg.forEach(option2 => {
        var ico_type = document.querySelector('input[name="icon_type"]:checked').value;
        option2.setAttribute("src", "https://www.skynettechnologies.com/sites/default/files/" + ico_type + ".svg");
    });

    typeOptions.forEach(option => {
        option.addEventListener("click", (event) => {
            sizeOptionsImg.forEach(option2 => {
                var ico_type = document.querySelector('input[name="icon_type"]:checked').value;
                option2.setAttribute("src", "https://www.skynettechnologies.com/sites/default/files/" + ico_type + ".svg");
            });
        });
    });

});
