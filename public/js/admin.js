const web_root =
  window.location.protocol +
  "//" +
  window.location.host +
  window.location.pathname.split("/").slice(0, 2).join("/").toLocaleLowerCase();
$(document).ready(function () {
  $(".feature-checkbox").change(function () {
    let categoryId = $(this).data("categoryid");
    let isChecked = $(this).prop("checked");
    $.ajax({
      url: `${web_root}/cap-nhat-danh-muc-noi-bat`, // Đường dẫn đến file xử lý cập nhật
      type: "POST",
      data: {
        category_id: categoryId,
        is_feature: isChecked ? 1 : 0, // Gửi giá trị 1 nếu checkbox được chọn, 0 nếu không
      },
      success: function (response) {},
      error: function () {
        alert("Có lỗi xảy ra khi cập nhật trạng thái.");
      },
    });
  });

  $(".hot-checkbox").change(function () {
    let productid = $(this).data("productid");
    let isChecked = $(this).prop("checked");
    $.ajax({
      url: `${web_root}/cap-nhat-san-pham-hot`, // Đường dẫn đến file xử lý cập nhật
      type: "POST",
      data: {
        product_id: productid,
        is_hot: isChecked ? 1 : 0, // Gửi giá trị 1 nếu checkbox được chọn, 0 nếu không
      },
      success: function (response) {},
      error: function () {
        alert("Có lỗi xảy ra khi cập nhật trạng thái.");
      },
    });
  });
});
