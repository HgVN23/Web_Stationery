(function ($) {
  "use strict";

  // Dropdown on mouse hover
  $(document).ready(function () {
    function toggleNavbarMethod() {
      if ($(window).width() > 768) {
        $(".navbar .dropdown")
          .on("mouseover", function () {
            $(".dropdown-toggle", this).trigger("click");
          })
          .on("mouseout", function () {
            $(".dropdown-toggle", this).trigger("click").blur();
          });
      } else {
        $(".navbar .dropdown").off("mouseover").off("mouseout");
      }
    }
    toggleNavbarMethod();
    $(window).resize(toggleNavbarMethod);
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Product Slider 4 Column
  $(".product-slider-4").slick({
    autoplay: true,
    infinite: true,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // // Product Slider 3 Column
  // $(".product-slider-3").slick({
  //   autoplay: true,
  //   infinite: true,
  //   dots: false,
  //   slidesToShow: 3,
  //   slidesToScroll: 1,
  //   responsive: [
  //     {
  //       breakpoint: 992,
  //       settings: {
  //         slidesToShow: 3,
  //       },
  //     },
  //     {
  //       breakpoint: 768,
  //       settings: {
  //         slidesToShow: 2,
  //       },
  //     },
  //     {
  //       breakpoint: 576,
  //       settings: {
  //         slidesToShow: 1,
  //       },
  //     },
  //   ],
  // });

  // // Single Product Slider
  // $(".product-slider-single").slick({
  //   infinite: true,
  //   dots: false,
  //   slidesToShow: 1,
  //   slidesToScroll: 1,
  // });

  // // Brand Slider
  // $(".brand-slider").slick({
  //   speed: 1000,
  //   autoplay: true,
  //   autoplaySpeed: 1000,
  //   infinite: true,
  //   arrows: false,
  //   dots: false,
  //   slidesToShow: 5,
  //   slidesToScroll: 1,
  //   responsive: [
  //     {
  //       breakpoint: 992,
  //       settings: {
  //         slidesToShow: 4,
  //       },
  //     },
  //     {
  //       breakpoint: 768,
  //       settings: {
  //         slidesToShow: 3,
  //       },
  //     },
  //     {
  //       breakpoint: 576,
  //       settings: {
  //         slidesToShow: 2,
  //       },
  //     },
  //     {
  //       breakpoint: 300,
  //       settings: {
  //         slidesToShow: 1,
  //       },
  //     },
  //   ],
  // });

  // Quantity
  $(".qty button").on("click", function () {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.hasClass("btn-increase")) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 0;
      }
    }
    $button.parent().find("input").val(newVal);
  });
  // Shipping address show hide
  $(".checkout #shipto").change(function () {
    if ($(this).is(":checked")) {
      $(".checkout .shipping-address").slideDown();
    } else {
      $(".checkout .shipping-address").slideUp();
    }
  });

  // Payment methods show hide
  $(".checkout .payment-method .custom-control-input").change(function () {
    if ($(this).prop("checked")) {
      var checkbox_id = $(this).attr("id");
      $(".checkout .payment-method .payment-content").slideUp();
      $("#" + checkbox_id + "-show").slideDown();
    }
  });
})(jQuery);

// show aleart
$(document).ready(function () {
  setTimeout(function () {
    $(".alert").alert("close");
  }, 3000); // 3000ms = 3 seconds
});

// sort products by price

$(document).ready(function () {
  $("#sortSelect").on("change", function () {
    // Lấy dữ liệu từ form
    var formData = $("#sortForm").serialize(); // Tạo chuỗi query từ form

    // Gửi yêu cầu AJAX
    $.ajax({
      url: "", // Địa chỉ URL để gửi yêu cầu
      method: "GET",
      data: formData, // Gửi dữ liệu
      success: function (response) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(response, "text/html");
        const content = doc.getElementById("product-container");
        const pagination = doc.getElementById("pagination");
        content &&
          (document.getElementById("product-container").innerHTML =
            content.innerHTML);
        pagination &&
          (document.getElementById("pagination").innerHTML =
            pagination.innerHTML);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error fetching data:", textStatus, errorThrown);
      },
    });
  });
});

const web_root =
  window.location.protocol +
  "//" +
  window.location.host +
  window.location.pathname.split("/").slice(0, 2).join("/").toLocaleLowerCase();

// handel btn add to cart
$(document).on("click", ".btn_addtocart", function () {
  let btn = $(this);
  let input = $(this)
    .closest(".action")
    .siblings(".quantity")
    .find("input.input_quantity");

  let prid = btn.data("pr-id");
  let dataobj = {
    pr_id: prid,
  };

  if (input.length > 0) {
    let quantityValue = parseInt(input.val());
    dataobj.quantity = quantityValue;
  }

  // Gửi yêu cầu AJAX
  $.ajax({
    url: `${web_root}/them-vao-gio-hang`, // Địa chỉ URL để gửi yêu cầu
    method: "POST",
    data: dataobj, // Gửi dữ liệu
    success: function (response) {
      let rs = JSON.parse(response);
      if (rs.success) {
        if (rs.totalcartitem) {
          document.querySelector(
            ".number_cart"
          ).textContent = `(${rs.totalcartitem})`;
        }
      } else {
        window.location.href = `${web_root}/dang-nhap`;
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error fetching data:", textStatus, errorThrown);
    },
  });
});

$(document).ready(function () {
  $(".btn_to_checkout").on("click", function (e) {
    e.preventDefault();
    // Gửi yêu cầu AJAX
    $.ajax({
      url: `${web_root}/loc-gio-hang`, // Địa chỉ URL để gửi yêu cầu
      method: "POST",
      data: "", // Gửi dữ liệu
      success: function (response) {
        let data = JSON.parse(response);

        if (data.success) {
          window.location.href = `${web_root}/thanh-toan`;
        } else {
          alert("Không có sản phẩm nào đủ số lượng để thanh toán.");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error fetching data:", textStatus, errorThrown);
      },
    });
  });

  $("#btn_checkout").on("click", function (e) {
    var confirm_checkout = confirm("Bạn có chắc chắn muốn thanh toán");
    if (confirm_checkout) {
      $.ajax({
        url: `${web_root}/tao-don-hang`, // Địa chỉ URL để gửi yêu cầu
        method: "POST",
        data: "", // Gửi dữ liệu
        success: function (response) {
          let rs = JSON.parse(response);

          if (rs.success) {
            if (rs.totalPrdPay) {
              if (rs.iscreate) {
                $(".content-checkout").html("");
                $(".alert-overlay")
                  .html(`<div class="alert alert-success" role="alert">
                                Tạo đơn hàng thành công!
                                </br>
                                Đơn hàng có ${rs.totalPrdPay} sản phẩm
                              </div>`);
                $(".number_cart").html(`(${rs.totalcartitem})`);

                setTimeout(function () {
                  $(".alert").alert("close");
                }, 5000);
              }
            } else {
              $(".alert-overlay")
                .html(`<div class="alert alert-danger" role="alert">
                                Không thể tạo đơn hàng, số lượng sản phẩm không hợp lệ!
                              </div>`);
            }
            setTimeout(function () {
              $(".alert").alert("close");
            }, 5000);
          } else {
            alert("Không có sản phẩm nào được thanh toán");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error fetching data:", textStatus, errorThrown);
        },
      });
    }
  });

  $("#btn_Update_Info").on("click", function (e) {
    let confirm_checkout = confirm("Xác nhận cập nhập thông tin");
    if (confirm_checkout) {
      const phone = $("#phone").val();
      const email = $("#email").val();
      const address = $("#address").val();

      const objdata = {
        phone: phone,
        email: email,
        address: address,
      };

      $.ajax({
        url: `${web_root}/cap-nhap-thong-tin`, // Địa chỉ URL để gửi yêu cầu
        method: "POST",
        data: objdata, // Gửi dữ liệu
        success: function (response) {
          let rs = JSON.parse(response);

          if (rs.success) {
            $(".alert-overlay")
              .html(`<div class="alert alert-success" role="alert">
                              Cập nhật thông tin thành công!
                    </div>`);
          }
          setTimeout(function () {
            $(".alert").alert("close");
          }, 3500);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error fetching data:", textStatus, errorThrown);
        },
      });
    }
  });

  $("#btn_Update_Password").on("click", function (e) {
    const curent_password = $("#curent_password").val();
    const new_password = $("#new_password").val();
    const confirm_password = $("#confirm_password").val();

    if (new_password === confirm_password) {
      let confirm_update = confirm("Xác nhận cập nhập thông tin");
      if (confirm_update) {
        if (new_password != curent_password) {
          const objdata = {
            curent_password: curent_password,
            new_password: new_password,
            confirm_password: confirm_password,
          };

          $.ajax({
            url: `${web_root}/cap-nhap-thong-tin`, // Địa chỉ URL để gửi yêu cầu
            method: "POST",
            data: objdata, // Gửi dữ liệu
            success: function (response) {
              let rs = JSON.parse(response);

              if (rs.isupdatepass) {
                $(".alert-overlay")
                  .html(`<div class="alert alert-success" role="alert">
                                  Cập nhật mật khẩu thành công!
                        </div>`);
              } else {
                $(".alert-overlay")
                  .html(`<div class="alert alert-danger" role="alert">
                                  Cập nhật mật khẩu thất bại!
                        </div>`);
              }
              if (rs.erroroldpass) {
                $(".alert-overlay")
                  .html(`<div class="alert alert-danger" role="alert">
                                Mật khẩu hiện tại không đúng!
                      </div>`);
              }

              setTimeout(function () {
                $(".alert").alert("close");
                if (rs.isupdatepass) {
                  window.location.reload();
                }
              }, 2500);
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.error("Error fetching data:", textStatus, errorThrown);
            },
          });
        } else {
          alert("Mật khẩu mới không trùng với mật khẩu cũ");
        }
      }
    } else {
      alert("Mật khẩu xác nhận không trùng với mật khẩu mới");
    }
  });

  // register account
  $("#form_register").on("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const formObject = {};
    formData.forEach((value, key) => {
      formObject[key] = value;
    });
    let password = formObject.password;
    let confirmPassword = formObject.confirm_password;

    if (password.length < 6) {
      alert("Mật khẩu phải có ít nhất 6 ký tự.");
      return false;
    }

    if (password !== confirmPassword) {
      alert("Mật khẩu và xác nhận mật khẩu không khớp!");
      return false;
    }

    $.ajax({
      url: `${web_root}/dang-ky-tai-khoan`, // Địa chỉ URL để gửi yêu cầu
      method: "POST",
      data: formData, // Dữ liệu form
      processData: false, // Không tự động xử lý dữ liệu
      contentType: false, // Không thay đổi content-type
      success: function (response) {
        let rs = JSON.parse(response);

        if (rs.isusernameexist) {
          $(".alert-overlay")
            .html(`<div class="alert alert-danger" role="alert">
                                Tên đăng nhập đã tồn tại!
                      </div>`);
        }

        if (rs.iscreatenewacc) {
          $(".alert-overlay")
            .html(`<div class="alert alert-success" role="alert">
                              Tạo tài khoản thành công!
                    </div>`);
        }

        setTimeout(function () {
          $(".alert").alert("close");
          if (rs.iscreatenewacc) {
            window.location = `${web_root}/dang-nhap`;
          }
        }, 1500);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error fetching data:", textStatus, errorThrown);
      },
    });
  });
});
