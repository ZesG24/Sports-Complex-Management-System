# HƯỚNG DẪN GITHUB COPILOT
## Dự án Sports Complex Management System

## 1. Tổng quan dự án

**Tên dự án:** Sports Complex Management System (Hệ thống quản lý khu liên hợp thể thao).

Đây là hệ thống website phục vụ việc quản lý sân thể thao, đặt sân trực tuyến, cung cấp dịch vụ đi kèm, bán sản phẩm thể thao, quản lý đơn hàng, tồn kho và doanh thu.

Hệ thống có ba nhóm vai trò chính:

- `user`: Khách hàng sử dụng dịch vụ đặt sân và mua sản phẩm thể thao.
- `owner`: Chủ sân quản lý sân thể thao và các hoạt động liên quan theo quyền được cấp.
- `admin`: Quản trị viên hoặc nhân viên được phân quyền quản lý các hoạt động của hệ thống.

Các phân hệ chính:

1. Quản lý tài khoản và xác thực.
2. Quản lý danh mục sân thể thao.
3. Đặt sân trực tuyến và kiểm tra lịch trống.
4. Quản lý dịch vụ đi kèm.
5. Quản lý thanh toán và hóa đơn đặt sân.
6. Quản lý cửa hàng sản phẩm thể thao.
7. Quản lý giỏ hàng và đơn hàng.
8. Quản lý nhập hàng và tồn kho.
9. Quản lý đánh giá sân.
10. Quản trị hệ thống, dashboard và báo cáo doanh thu.

**Nguyên tắc quan trọng:** Nghiệp vụ đã được duyệt là căn cứ chính để phát triển hệ thống. Không tự ý thêm chức năng, thay đổi quy trình nghiệp vụ hoặc mở rộng phạm vi dự án khi chưa có yêu cầu rõ ràng.

Trước khi thực hiện bất kỳ thay đổi nào, hãy kiểm tra cấu trúc dự án, các tệp hiện có và cách triển khai những chức năng liên quan để bảo đảm tính nhất quán.

---

## 2. Công nghệ bắt buộc

### 2.1. Backend

- PHP.
- Laravel theo phiên bản đang được sử dụng trong dự án.
- Laravel Routing, Controller, Middleware, Validation, Eloquent ORM và Migration.
- Blade Template Engine để hiển thị giao diện.

### 2.2. Frontend

- HTML5.
- CSS3.
- Bootstrap 5.
- JavaScript thuần (Vanilla JavaScript).
- Laravel Blade.

### 2.3. Cơ sở dữ liệu

- Sử dụng hệ quản trị cơ sở dữ liệu đã được cấu hình trong dự án.
- Tuân thủ cấu trúc, quy ước đặt tên và quan hệ dữ liệu hiện có.
- Sử dụng Laravel Migration để quản lý các thay đổi cấu trúc cơ sở dữ liệu.

### 2.4. Những công nghệ không được tự ý sử dụng

Không tự ý đưa các công nghệ sau vào dự án khi chưa được cho phép:

- React.
- Vue.js.
- Inertia.js.
- Tailwind CSS.
- Một ứng dụng frontend tách biệt khỏi Laravel.
- Các thư viện giao diện bổ sung không cần thiết hoặc trùng lặp chức năng với Bootstrap 5.

Không thay đổi công nghệ cốt lõi chỉ vì một công nghệ khác thuận tiện hơn.

---

## 3. Nguyên tắc phát triển phần mềm

1. Đọc và hiểu các tệp liên quan trước khi sửa code.
2. Hiểu rõ yêu cầu nghiệp vụ trước khi triển khai chức năng.
3. Ưu tiên code rõ ràng, dễ đọc, dễ bảo trì và có khả năng tái sử dụng.
4. Tuân thủ kiến trúc và quy ước đặt tên đang được sử dụng trong dự án.
5. Không tạo thêm Controller, Model, Component hoặc chức năng trùng lặp khi đã có thành phần phù hợp.
6. Không đặt phần lớn logic nghiệp vụ trực tiếp trong Blade.
7. Sử dụng các cơ chế có sẵn của Laravel thay vì tự xây dựng lại những chức năng framework đã hỗ trợ.
8. Phân tách hợp lý giữa giao diện, xử lý nghiệp vụ và truy cập dữ liệu.
9. Chỉ thay đổi những phần cần thiết để hoàn thành yêu cầu.
10. Không xóa hoặc viết lại các chức năng đang hoạt động nếu không có lý do rõ ràng.
11. Không tạo dữ liệu giả để thay thế dữ liệu thật trong chức năng chính thức.
12. Không tự nhận rằng một chức năng đã hoàn thành nếu chưa kiểm tra code và các trường hợp quan trọng.
13. Khi phát hiện yêu cầu mâu thuẫn với nghiệp vụ đã duyệt, hãy chỉ rõ điểm mâu thuẫn và đề xuất phương án trước khi thay đổi.
14. Không tự ý cài đặt thêm package, thay đổi cấu hình môi trường hoặc nâng cấp phiên bản framework nếu không cần thiết.

---

## 4. Quy chuẩn thiết kế giao diện UI/UX

### 4.1. Định hướng thiết kế

Website phải có giao diện hiện đại, chuyên nghiệp, trực quan và phù hợp với một hệ thống quản lý sân thể thao.

Ưu tiên:

- Bố cục rõ ràng, có phân cấp thông tin.
- Phong cách thiết kế thống nhất trên toàn hệ thống.
- Khoảng cách, kích thước, màu sắc và kiểu chữ hợp lý.
- Giao diện sạch, dễ đọc, không quá nhiều chi tiết trang trí.
- Các thành phần có trạng thái tương tác rõ ràng.
- Responsive trên máy tính, máy tính bảng và điện thoại.
- Tối ưu trải nghiệm sử dụng thay vì chỉ tập trung vào hình thức.

Không tạo giao diện sơ sài, lỗi thời hoặc chỉ gồm các bảng HTML đơn giản.

Không lạm dụng gradient, hiệu ứng phát sáng, animation, bóng đổ hoặc các chi tiết trang trí không phục vụ trải nghiệm người dùng.

### 4.2. Quy chuẩn Bootstrap 5

- Sử dụng Bootstrap 5 làm framework giao diện chính.
- Ưu tiên các component có sẵn của Bootstrap khi phù hợp.
- Sử dụng Grid System và Flexbox hợp lý.
- Hạn chế CSS inline.
- Không viết lại các component Bootstrap nếu không cần thiết.
- Không sử dụng class của Tailwind CSS.
- Kiểm tra các breakpoint để bảo đảm giao diện responsive.
- Bảo đảm nút, biểu mẫu, bảng và modal có kích thước phù hợp.

### 4.3. Màu sắc và kiểu chữ

Thiết lập hệ thống màu sắc nhất quán cho toàn website.

Nên có các màu dùng chung cho:

- Màu chủ đạo.
- Màu phụ.
- Màu nền.
- Màu bề mặt của thẻ và bảng.
- Màu chữ chính và phụ.
- Màu thành công.
- Màu cảnh báo.
- Màu lỗi.
- Màu đường viền.

Nếu dự án đã có bộ màu hoặc thiết kế chung, hãy sử dụng lại thay vì tạo một hệ màu mới cho từng trang.

Ưu tiên chữ dễ đọc, kích thước hợp lý và độ tương phản đủ cao.

### 4.4. Các thành phần giao diện

Các thành phần dùng chung phải được thiết kế thống nhất, bao gồm:

- Thanh điều hướng.
- Sidebar quản trị.
- Header và footer.
- Breadcrumb.
- Nút thao tác.
- Form nhập liệu.
- Ô tìm kiếm.
- Bộ lọc.
- Bảng dữ liệu.
- Phân trang.
- Thẻ thống kê.
- Badge trạng thái.
- Modal xác nhận.
- Thông báo thành công và thất bại.
- Trạng thái đang tải.
- Trạng thái không có dữ liệu.

Các trang cùng phân hệ phải tái sử dụng layout và component phù hợp.

### 4.5. Yêu cầu đối với trang quản trị

Dashboard cần có bố cục dễ theo dõi và thể hiện thông tin có ý nghĩa với nghiệp vụ.

Tùy theo dữ liệu thực tế, có thể sử dụng:

- Thẻ thống kê.
- Bảng dữ liệu.
- Bộ lọc theo ngày hoặc trạng thái.
- Biểu đồ doanh thu.
- Danh sách lịch đặt gần nhất.
- Danh sách đơn hàng cần xử lý.
- Thông tin sản phẩm sắp hết hàng.

Không hiển thị số liệu giả như thể đó là dữ liệu thực của hệ thống.

Không thêm biểu đồ hoặc thẻ thống kê không có ý nghĩa đối với nghiệp vụ.

### 4.6. Yêu cầu đối với giao diện khách hàng

Giao diện khách hàng cần tạo cảm giác thân thiện, dễ sử dụng và hỗ trợ khách hàng hoàn thành tác vụ nhanh chóng.

Ưu tiên trải nghiệm cho các chức năng:

- Xem danh sách và chi tiết sân.
- Chọn ngày và giờ đặt sân.
- Nhận biết khung giờ còn trống hoặc đã được đặt.
- Chọn dịch vụ đi kèm.
- Xem tổng tiền trước khi xác nhận.
- Theo dõi kết quả thanh toán.
- Xem lịch sử đặt sân.
- Duyệt sản phẩm thể thao.
- Chọn biến thể và thêm sản phẩm vào giỏ.
- Theo dõi đơn hàng.
- Gửi đánh giá sân.

### 4.7. Quy tắc khi xây dựng giao diện

Khi được yêu cầu tạo một trang mới:

1. Kiểm tra layout và component hiện có.
2. Xác định người dùng và mục đích của trang.
3. Xây dựng bố cục hoàn chỉnh, không chỉ tạo một vài thành phần rời rạc.
4. Xử lý các trạng thái dữ liệu: có dữ liệu, không có dữ liệu, lỗi và đang tải nếu phù hợp.
5. Bảo đảm các nút và biểu mẫu có hành vi rõ ràng.
6. Kiểm tra giao diện ở các kích thước màn hình khác nhau.
7. Tái sử dụng CSS và component chung khi có thể.
8. Không tạo nút chỉ để trang trí nếu nút đó được thể hiện như một chức năng có thể sử dụng.

---

## 5. Quy chuẩn Laravel và Blade

### 5.1. Routes

- Khai báo route theo đúng nhóm chức năng.
- Sử dụng tên route có ý nghĩa.
- Tận dụng route model binding khi phù hợp.
- Áp dụng middleware xác thực và phân quyền cho các route cần bảo vệ.
- Không để người dùng truy cập chức năng trái quyền chỉ vì họ biết URL.

### 5.2. Controllers

- Controller chịu trách nhiệm tiếp nhận yêu cầu, phối hợp xử lý và trả về kết quả.
- Tránh viết Controller quá dài với nhiều nhánh xử lý phức tạp.
- Sử dụng Form Request hoặc cơ chế validation phù hợp khi cần.
- Không tin tưởng dữ liệu do trình duyệt gửi lên.
- Kiểm tra quyền truy cập trước khi sửa hoặc xóa dữ liệu.
- Tách logic nghiệp vụ phức tạp sang Service hoặc thành phần phù hợp khi dự án cần.

Không tạo thêm tầng kiến trúc chỉ để làm code phức tạp hơn. Hãy chọn giải pháp phù hợp với quy mô hiện tại.

### 5.3. Models và Eloquent ORM

- Khai báo quan hệ Eloquent chính xác.
- Sử dụng tên quan hệ dễ hiểu.
- Khai báo `$fillable` hoặc `$guarded` phù hợp để tránh mass assignment không an toàn.
- Sử dụng eager loading khi cần để hạn chế truy vấn N+1.
- Không lấy toàn bộ dữ liệu nếu chỉ cần một phần nhỏ.
- Kiểm tra dữ liệu đầu vào và điều kiện nghiệp vụ trước khi ghi dữ liệu.

### 5.4. Blade

- Sử dụng Blade để hiển thị dữ liệu từ Laravel.
- Tái sử dụng layout, partial và component.
- Không lặp lại toàn bộ HTML dùng chung giữa nhiều trang.
- Ưu tiên cú pháp Blade chuẩn.
- Sử dụng `{{ }}` để hiển thị dữ liệu đã được escape mặc định.
- Chỉ sử dụng `{!! !!}` khi thực sự cần và đã kiểm soát an toàn nội dung HTML.
- Không đặt mật khẩu, thông tin xác thực hoặc dữ liệu nhạy cảm vào HTML.
- Không nhúng logic nghiệp vụ phức tạp vào template.

### 5.5. CSS và JavaScript

- Tổ chức CSS và JavaScript theo cấu trúc hiện có của dự án.
- Tái sử dụng các quy tắc CSS dùng chung.
- Hạn chế CSS inline.
- Không sao chép nhiều phiên bản của cùng một đoạn code.
- Sử dụng JavaScript thuần cho các tương tác phía trình duyệt.
- Không đưa React, Vue hoặc framework frontend khác vào khi chưa được cho phép.
- JavaScript chỉ hỗ trợ trải nghiệm người dùng; mọi kiểm tra nghiệp vụ quan trọng phải được thực hiện ở backend.

---

## 6. Quy tắc nghiệp vụ bắt buộc

Các quy tắc sau phải được bảo đảm trong quá trình triển khai.

### 6.1. Tài khoản và xác thực

Hệ thống hỗ trợ:

- Đăng ký bằng tên đăng nhập, họ tên, số điện thoại, email, địa chỉ và mật khẩu.
- Xác thực đăng ký bằng OTP gửi qua email.
- Đăng nhập bằng tên đăng nhập hoặc email và mật khẩu.
- Đăng xuất.
- Gửi lại OTP.
- Quên mật khẩu và đặt lại mật khẩu bằng liên kết hoặc token.
- Cập nhật hồ sơ và đổi mật khẩu.

Yêu cầu:

- Kiểm tra tên đăng nhập và email trùng lặp.
- Mật khẩu phải được băm an toàn bằng cơ chế phù hợp của Laravel.
- OTP phải có thời hạn, được xác minh ở backend và có biện pháp hạn chế việc gửi hoặc thử mã liên tục.
- Token đặt lại mật khẩu phải được kiểm tra hợp lệ và hết hạn theo quy trình.
- Không lưu mật khẩu hoặc OTP dưới dạng văn bản thuần khi không cần thiết.
- Không tiết lộ thông tin xác thực trong log hoặc thông báo lỗi.

### 6.2. Danh mục và quản lý sân

Các loại sân được duyệt:

- Bóng đá.
- Cầu lông.
- Pickleball.

Thông tin sân có thể bao gồm:

- Tên sân.
- Loại sân.
- Giá thuê.
- Trạng thái hoạt động.
- Mô tả.
- Đánh giá.

Owner có thể quản lý sân trong phạm vi quyền được cấp.

Không xóa sân theo cách làm mất lịch sử đặt sân, hóa đơn hoặc dữ liệu liên quan. Nếu cần, hãy sử dụng cơ chế ngừng hoạt động hoặc xóa mềm phù hợp với thiết kế hiện có.

### 6.3. Đặt sân và kiểm tra lịch trống

Khách hàng có thể:

- Chọn sân.
- Chọn ngày đặt.
- Chọn giờ bắt đầu và giờ kết thúc.
- Chọn thời lượng thuê.
- Xem khung giờ còn trống.
- Chọn dịch vụ đi kèm.
- Xem thông tin xác nhận và tổng tiền.

Yêu cầu bắt buộc:

1. Giờ kết thúc phải sau giờ bắt đầu.
2. Thời gian đặt phải đáp ứng các giới hạn hợp lệ của hệ thống.
3. Tính tiền dựa trên giá và thời lượng theo quy tắc đã thống nhất.
4. Kiểm tra lịch trùng ở backend.
5. Không cho phép hai lịch đang chiếm dụng cùng một sân có khoảng thời gian giao nhau.
6. Thực hiện kiểm tra xung đột ngay cả khi nhiều khách gửi yêu cầu gần như đồng thời.
7. Xem xét transaction và cơ chế khóa dữ liệu phù hợp để tránh đặt trùng trong điều kiện cạnh tranh.
8. Không chỉ dựa vào JavaScript hoặc trạng thái hiển thị trên giao diện để quyết định khung giờ còn trống.

Không tự ý đặt ra quy tắc giá theo giờ cao điểm, ngày lễ hoặc cuối tuần khi nghiệp vụ chưa quy định.

### 6.4. Dịch vụ đi kèm

Các dịch vụ có thể bao gồm:

- Nước uống.
- Thuê giày.
- Thuê vớ.
- Thuê quần áo.
- Các dịch vụ khác được quản lý trong hệ thống.

Chi tiết dịch vụ phải ghi nhận tối thiểu những thông tin cần thiết theo thiết kế dữ liệu, chẳng hạn:

- Dịch vụ được chọn.
- Số lượng.
- Đơn giá tại thời điểm đặt.
- Thành tiền.

Kiểm tra số lượng hợp lệ và đơn giá ở backend.

Không tin tưởng đơn giá được gửi từ trình duyệt. Khi cần lưu lịch sử giao dịch, hãy lưu lại đơn giá áp dụng tại thời điểm giao dịch thay vì luôn lấy giá hiện tại của dịch vụ.

### 6.5. Thanh toán và hóa đơn đặt sân

Hệ thống hỗ trợ:

- Thanh toán qua MoMo.
- Thanh toán tại sân.

Yêu cầu:

- Tạo dữ liệu đặt sân và hóa đơn nhất quán.
- Theo dõi trạng thái thanh toán theo quy trình đã thống nhất.
- Xác minh kết quả thanh toán qua cơ chế xác thực của cổng MoMo.
- Không xem việc khách hàng quay lại trang thành công là bằng chứng duy nhất của giao dịch thành công.
- Kiểm tra tính hợp lệ của mã giao dịch và thông tin callback.
- Bảo đảm callback được xử lý an toàn khi nhà cung cấp gửi lại nhiều lần.
- Không ghi nhận một giao dịch thành công nhiều lần.
- Thanh toán tại sân phải có quy trình xác nhận bởi người được phân quyền.

Không tự ý đưa thêm cổng thanh toán ngoài phạm vi đã duyệt.

### 6.6. Hủy lịch đặt

Trước khi hủy lịch, hệ thống phải kiểm tra:

- Người thực hiện có quyền hủy lịch hay không.
- Lịch đặt có thuộc khách hàng đó hay không, nếu người hủy là khách hàng.
- Thời điểm hiện tại so với thời gian đặt.
- Trạng thái hiện tại của lịch.
- Lịch đã bị hủy trước đó hay chưa.

Lịch đã diễn ra hoặc đã hủy không được hủy lại theo quy trình đã duyệt.

Ghi nhận đúng đối tượng thực hiện hủy khi cần phân biệt:

- Khách hàng hủy.
- Owner hủy.
- Admin hủy.

Không tự ý xây dựng chính sách hoàn tiền hoặc phí phạt khi nghiệp vụ chưa được phê duyệt.

### 6.7. Đánh giá sân

Khách hàng chỉ được đánh giá khi:

- Lịch đặt đã kết thúc.
- Lịch đặt không bị hủy.
- Lịch đặt chưa được đánh giá trước đó.
- Khách hàng có quyền đánh giá lịch đặt đó.

Đánh giá bao gồm:

- Số sao.
- Nội dung nhận xét.

Phải kiểm tra các điều kiện trên ở backend và ngăn việc gửi đánh giá trùng lặp.

Không cho phép khách hàng đánh giá sân chỉ vì họ đã đăng nhập hoặc đã xem chi tiết sân.

### 6.8. Sản phẩm thể thao và giỏ hàng

Khách hàng có thể:

- Xem danh mục sản phẩm.
- Xem chi tiết sản phẩm.
- Chọn biến thể hoặc kích thước.
- Chọn số lượng.
- Thêm vào giỏ hàng.
- Cập nhật số lượng.
- Xóa sản phẩm khỏi giỏ.

Yêu cầu:

- Kiểm tra biến thể có tồn tại và đang được phép bán.
- Kiểm tra số lượng hợp lệ.
- Kiểm tra tồn kho của đúng biến thể.
- Không tin tưởng giá và tổng tiền do trình duyệt gửi lên.
- Tính lại tổng tiền ở backend.
- Không cho phép mua số lượng vượt quá tồn kho hợp lệ.

### 6.9. Đơn hàng và tồn kho

Quy trình gồm:

1. Khách hàng cung cấp thông tin nhận hàng.
2. Chọn phương thức thanh toán.
3. Hệ thống kiểm tra tồn kho.
4. Hệ thống tạo đơn hàng và chi tiết đơn hàng.
5. Nếu chọn MoMo, hệ thống tạo yêu cầu thanh toán theo quy trình tích hợp.
6. Hệ thống cập nhật trạng thái đơn hàng và thanh toán theo kết quả thực tế.
7. Admin hoặc nhân viên được phân quyền cập nhật trạng thái xử lý đơn hàng.

Yêu cầu:

- Lưu giá sản phẩm tại thời điểm mua trong chi tiết đơn hàng.
- Lưu đúng biến thể, số lượng và thành tiền.
- Kiểm tra tồn kho trong transaction khi tạo đơn.
- Bảo đảm nhiều yêu cầu mua cùng lúc không làm tồn kho âm.
- Cập nhật tồn kho theo đúng quy trình thanh toán và xử lý đơn hàng đã thống nhất.
- Không giảm tồn kho nhiều lần khi callback được gửi lại.
- Phân biệt trạng thái thanh toán với trạng thái xử lý đơn hàng.
- Không tự ý xây dựng quy trình hoàn tiền, đổi trả hoặc vận chuyển phức tạp khi chưa được duyệt.

**Lưu ý:** Trước khi triển khai cơ chế trừ tồn kho, phải xác định rõ thời điểm trừ kho và cách xử lý đơn hàng thanh toán thất bại hoặc bị hủy. Không được tự chọn một quy trình có thể gây sai lệch tồn kho.

### 6.10. Quản trị và báo cáo

Các chức năng quản trị theo nghiệp vụ được duyệt bao gồm:

- Dashboard và báo cáo.
- Quản lý sân.
- Quản lý dịch vụ.
- Quản lý sản phẩm.
- Quản lý biến thể.
- Quản lý nhập hàng và tồn kho.
- Quản lý khách hàng và tài khoản nhân viên.
- Quản lý lịch đặt.
- Quản lý đơn hàng.
- Xác nhận thanh toán theo quyền.
- Theo dõi doanh thu đặt sân và doanh thu dịch vụ.

Dữ liệu báo cáo phải được tổng hợp từ dữ liệu giao dịch thực tế.

Khi tính doanh thu, phải xác định rõ trạng thái giao dịch được tính vào doanh thu. Không cộng các hóa đơn chưa thanh toán vào doanh thu thực nhận nếu nghiệp vụ chưa quy định như vậy.

Phạm vi truy cập dữ liệu của Owner và Admin phải tuân theo quy tắc phân quyền đã thống nhất.

---

## 7. Phân quyền hệ thống

### 7.1. Khách hàng (`user`)

Được phép thực hiện các chức năng:

- Quản lý hồ sơ cá nhân.
- Đăng ký, đăng nhập và xác thực tài khoản.
- Xem danh sách và chi tiết sân.
- Kiểm tra giờ trống và đặt sân.
- Chọn dịch vụ đi kèm.
- Thanh toán và xem hóa đơn.
- Xem lịch sử đặt sân.
- Hủy lịch đủ điều kiện.
- Xem sản phẩm và quản lý giỏ hàng.
- Đặt hàng và theo dõi đơn hàng.
- Đánh giá sân khi đủ điều kiện.

Không được truy cập chức năng quản trị hoặc sửa dữ liệu thuộc khách hàng khác.

### 7.2. Chủ sân (`owner`)

Được phép thực hiện các chức năng trong phạm vi quyền được cấp:

- Thêm, sửa và cập nhật thông tin sân.
- Quản lý loại sân, giá thuê, trạng thái và mô tả.
- Xem lịch đặt sân.
- Xem chi tiết lịch đặt.
- Xác nhận thanh toán tại sân khi được phân quyền.
- Hủy lịch theo quy định.
- Theo dõi các hoạt động và số liệu được phép truy cập.
- Quản lý nhân viên nếu hệ thống cho phép.

Không tự ý cho Owner quyền truy cập toàn bộ dữ liệu hệ thống.

### 7.3. Admin và nhân viên

Các chức năng được phân công theo quyền bao gồm:

- Dashboard và báo cáo.
- Quản lý đặt sân.
- Quản lý khách hàng và tài khoản nhân viên.
- Quản lý sân và dịch vụ.
- Quản lý sản phẩm, biến thể và tồn kho.
- Quản lý nhập hàng.
- Quản lý đơn hàng.
- Cập nhật trạng thái xử lý và thanh toán.
- Theo dõi doanh thu theo phạm vi được cấp.

Không mặc định mọi nhân viên đều có toàn bộ quyền của Admin nếu hệ thống hỗ trợ phân quyền chi tiết.

### 7.4. Quy tắc phân quyền

- Xác thực và phân quyền phải được kiểm tra ở backend.
- Không chỉ ẩn nút hoặc menu trên giao diện.
- Không tin tưởng role được gửi từ trình duyệt.
- Kiểm tra quyền truy cập đến từng bản ghi khi cần.
- Chỉ cho phép người có quyền thực hiện thao tác sửa, xóa hoặc xác nhận giao dịch.
- Không cho phép người dùng tự nâng cấp vai trò tài khoản.
- Không để khách hàng xem hoặc chỉnh sửa thông tin cá nhân, đơn hàng và lịch đặt của người khác.

---

## 8. Quy ước thiết kế cơ sở dữ liệu

Các nhóm dữ liệu nghiệp vụ chính đã được xác định:

- `taikhoan`
- `khachhang`
- `loaisan`
- `san`
- `datsan`
- `chitietdichvu`
- `dichvu`
- `hoadon`
- `danhgia`
- `sanpham`
- `bienthesanpham`
- `donhang`
- `chitietdonhang`
- `nhaphang` hoặc `nhapsanpham`
- Dữ liệu tồn kho.
- Dữ liệu phục vụ báo cáo.

Tên trên là tên nghiệp vụ tham chiếu, không phải yêu cầu phải đổi tên các bảng hiện có.

### Quy tắc thiết kế

1. Kiểm tra schema hiện tại trước khi tạo bảng mới.
2. Tôn trọng quy ước đặt tên đã được sử dụng trong dự án.
3. Xác định khóa chính, khóa ngoại và quan hệ dữ liệu rõ ràng.
4. Bổ sung unique constraint cho những dữ liệu bắt buộc không trùng.
5. Sử dụng kiểu dữ liệu phù hợp cho tiền, thời gian, số lượng và trạng thái.
6. Thiết lập index cho các cột thường xuyên dùng để tìm kiếm, lọc hoặc kiểm tra xung đột.
7. Sử dụng transaction cho các thao tác cần bảo đảm tính nhất quán dữ liệu.
8. Không xóa dữ liệu lịch sử quan trọng chỉ để đơn giản hóa quan hệ.
9. Sử dụng soft delete khi phù hợp với nghiệp vụ và thiết kế hiện tại.
10. Không lưu dữ liệu có thể tính toán lại nếu không có lý do nghiệp vụ rõ ràng.
11. Với giao dịch lịch sử, lưu các giá trị cần thiết tại thời điểm giao dịch để tránh thay đổi lịch sử khi giá hiện tại được cập nhật.
12. Không tự ý đổi tên hoặc xóa cột đang được nhiều chức năng sử dụng.

Trước khi tạo migration, phải kiểm tra migration và schema hiện có để tránh tạo bảng hoặc cột trùng lặp.

---

## 9. Phạm vi không thuộc dự án

Không tự ý triển khai hoặc mô tả các chức năng sau như thể chúng đã được duyệt:

- Marketplace cho nhiều cơ sở kinh doanh độc lập.
- Tìm kiếm sân bằng GPS hoặc khoảng cách địa lý.
- Giá thuê thay đổi tự động theo giờ, ngày lễ hoặc cuối tuần.
- Voucher và hệ thống mã giảm giá.
- Ví doanh thu cho Owner.
- Rút tiền và tự động chia hoa hồng.
- QR check-in.
- Thông báo push.
- Quản lý thẻ thanh toán.
- Cơ chế tự động phân chia doanh thu giữa nhiều bên.

Chỉ bổ sung các chức năng này khi người dùng hoặc người phụ trách dự án yêu cầu và phê duyệt rõ ràng.

---

## 10. Bảo mật và an toàn dữ liệu

- Sử dụng cơ chế xác thực và phân quyền của Laravel phù hợp với dự án.
- Validate mọi dữ liệu đầu vào ở backend.
- Sử dụng Eloquent hoặc parameter binding để hạn chế SQL injection.
- Bảo vệ các thao tác thay đổi dữ liệu bằng cơ chế CSRF phù hợp.
- Escape nội dung hiển thị để hạn chế XSS.
- Kiểm tra quyền truy cập trước khi đọc hoặc thay đổi dữ liệu nhạy cảm.
- Không đưa mật khẩu, token, khóa API hoặc thông tin thanh toán vào mã nguồn.
- Không đưa tệp `.env` lên Git.
- Không ghi log thông tin xác thực hoặc dữ liệu nhạy cảm không cần thiết.
- Không tin tưởng giá, số tiền, role, trạng thái thanh toán hoặc tồn kho được gửi trực tiếp từ trình duyệt.
- Kiểm tra tính nhất quán dữ liệu trước và sau các giao dịch quan trọng.
- Không tự ý tắt middleware, validation hoặc cơ chế bảo vệ để làm chức năng chạy được.
- Không sửa cấu hình môi trường sản xuất nếu chưa có sự cho phép.

---

## 11. Quy trình làm việc của GitHub Copilot

Khi nhận một yêu cầu, hãy thực hiện theo trình tự sau.

### Bước 1: Phân tích

- Xác định chức năng cần thực hiện.
- Xác định vai trò sử dụng chức năng.
- Xác định các quy tắc nghiệp vụ liên quan.
- Kiểm tra những tệp đang triển khai chức năng tương ứng.
- Xác định những phần có khả năng bị ảnh hưởng.

### Bước 2: Lập kế hoạch

Với yêu cầu phức tạp, hãy trình bày kế hoạch ngắn gọn gồm:

- Những tệp cần sửa hoặc tạo.
- Logic nghiệp vụ cần triển khai.
- Các thay đổi về cơ sở dữ liệu nếu có.
- Những rủi ro và trường hợp cần kiểm tra.

Không cần lập kế hoạch dài dòng đối với những thay đổi nhỏ, rõ ràng.

### Bước 3: Triển khai

- Tuân thủ công nghệ và quy ước của dự án.
- Ưu tiên tái sử dụng code hiện có.
- Chỉ sửa các tệp liên quan.
- Không tự ý thay đổi các chức năng khác.
- Không bỏ qua validation, phân quyền hoặc kiểm tra nghiệp vụ.
- Không thay dữ liệu thật bằng dữ liệu giả để làm giao diện trông hoàn chỉnh.

### Bước 4: Kiểm tra

Sau khi triển khai, hãy:

- Kiểm tra cú pháp và lỗi rõ ràng.
- Kiểm tra các route liên quan.
- Kiểm tra validation và phân quyền.
- Kiểm tra các trường hợp thành công và thất bại.
- Kiểm tra các trạng thái dữ liệu quan trọng.
- Kiểm tra giao diện trên các kích thước màn hình phù hợp.
- Chạy các bài kiểm tra hiện có nếu môi trường cho phép.

Nếu không thể chạy kiểm thử, hãy nêu rõ phần nào chưa được kiểm tra. Không được tuyên bố đã kiểm thử thành công khi chưa thực hiện.

### Bước 5: Báo cáo

Kết thúc công việc bằng một bản tóm tắt ngắn:

- Đã thực hiện những gì.
- Các tệp đã tạo hoặc chỉnh sửa.
- Migration hoặc cấu hình cần thực hiện nếu có.
- Cách kiểm tra chức năng.
- Những phần còn thiếu hoặc cần người dùng xác nhận.

Không tự ý commit, push hoặc merge Git nếu chưa được yêu cầu.

---

## 12. Quy tắc Git khi làm việc nhóm

Dự án có nhiều người cùng phát triển, vì vậy cần hạn chế xung đột code.

### 12.1. Phân nhánh

Không làm việc trực tiếp trên `main` theo quy trình mặc định.

Quy ước tên nhánh:

- `feature/ten-chuc-nang`: Chức năng mới.
- `fix/ten-loi`: Sửa lỗi.
- `refactor/ten-noi-dung`: Tái cấu trúc code.
- `docs/ten-tai-lieu`: Cập nhật tài liệu.

Tên nhánh viết thường, không dấu và dùng dấu gạch ngang khi phù hợp.

### 12.2. Trước khi bắt đầu công việc

Kiểm tra trạng thái Git:

```bash
git status
```

Bảo đảm các thay đổi đang làm dở đã được bảo vệ trước khi chuyển nhánh.

Cập nhật `main`:

```bash
git switch main
git pull --ff-only origin main
```

Tạo nhánh mới:

```bash
git switch -c feature/ten-chuc-nang
```

Không tự ý ghi đè hoặc xóa thay đổi chưa được lưu của người khác.

### 12.3. Commit

Nên chia công việc thành các commit nhỏ, có ý nghĩa.

Trước khi commit:

```bash
git status
git diff
git diff --staged
```

Chỉ đưa vào commit những tệp thuộc phạm vi công việc.

Quy ước thông điệp commit:

- `feat:` Thêm chức năng.
- `fix:` Sửa lỗi.
- `refactor:` Tái cấu trúc.
- `style:` Điều chỉnh giao diện hoặc định dạng code không đổi nghiệp vụ.
- `docs:` Cập nhật tài liệu.
- `test:` Thêm hoặc sửa kiểm thử.
- `chore:` Công việc bảo trì.

Ví dụ:

```bash
git add app/Http/Controllers/BookingController.php
git commit -m "feat: implement booking management"
```

Không commit toàn bộ dự án một cách máy móc nếu có các tệp không liên quan.

### 12.4. Push và Pull Request

Lần đầu đẩy nhánh:

```bash
git push -u origin feature/ten-chuc-nang
```

Các lần tiếp theo:

```bash
git push
```

Sau đó tạo Pull Request trên GitHub để xem xét và hợp nhất vào `main`.

Trước khi hợp nhất:

- Kiểm tra các thay đổi.
- Xem xét xung đột.
- Kiểm tra những chức năng có thể bị ảnh hưởng.
- Không đưa thông tin bí mật vào commit.

### 12.5. Những tệp cần đặc biệt cẩn thận

Khi nhiều người cùng làm, cần trao đổi trước khi sửa các tệp dùng chung như:

- `routes/web.php`
- Layout Blade chính.
- Sidebar và navbar.
- Các file CSS và JavaScript dùng chung.
- Migration.
- Cấu hình xác thực.
- Middleware phân quyền.
- Các model và service được nhiều phân hệ sử dụng.

Nếu hai người cùng phát triển các phân hệ khác nhau, hãy thống nhất trước về route, tên model, quan hệ dữ liệu và component dùng chung.

### 12.6. Những thao tác Git nguy hiểm

Không tự ý chạy các lệnh có thể xóa hoặc ghi đè dữ liệu, chẳng hạn:

```bash
git reset --hard
git clean -fd
git push --force
git branch -D
```

Chỉ thực hiện khi đã hiểu hậu quả, xác định rõ phạm vi ảnh hưởng và được người dùng cho phép.

Không tự ý commit, push, merge hoặc xóa nhánh thay người dùng.

---

## 13. Quản lý tệp và cấu hình

- Không commit `.env`.
- Không commit mật khẩu, token hoặc khóa API.
- Không commit thư mục `vendor/` hoặc `node_modules/` nếu quy trình dự án không yêu cầu.
- Kiểm tra `.gitignore` trước khi thêm tệp.
- Không xóa các tệp cấu hình hiện có nếu chưa xác định được tác dụng.
- Khi thêm biến môi trường mới, cập nhật `.env.example` bằng giá trị mẫu không chứa thông tin bí mật.
- Không tự ý thay đổi thông tin kết nối cơ sở dữ liệu đang hoạt động.
- Không chạy lệnh có thể xóa dữ liệu thật khi chưa được cho phép.
- Không sửa hoặc ghi đè tệp của người khác ngoài phạm vi công việc.

---

## 14. Nguyên tắc ưu tiên khi có mâu thuẫn

Khi xử lý yêu cầu, áp dụng thứ tự ưu tiên sau:

1. Yêu cầu cụ thể mới nhất của người dùng có thẩm quyền đối với phần việc đang thực hiện.
2. Nghiệp vụ đã được duyệt của dự án.
3. Kiến trúc và quy ước hiện có của mã nguồn.
4. Các quy chuẩn công nghệ và giao diện trong tài liệu này.
5. Đề xuất tối ưu hóa của Copilot.

Nếu yêu cầu mới có vẻ mâu thuẫn với nghiệp vụ đã duyệt, hãy nêu rõ mâu thuẫn và hỏi lại trước khi thực hiện thay đổi ảnh hưởng đến thiết kế hệ thống.

Không tự ý đưa thêm nghiệp vụ ngoài phạm vi dự án.

---

## 15. Yêu cầu cuối cùng

Mục tiêu không chỉ là tạo ra code chạy được, mà là xây dựng một hệ thống quản lý sân thể thao:

- Đúng nghiệp vụ đã duyệt.
- Giao diện hiện đại và nhất quán.
- Dễ sử dụng.
- Có cấu trúc rõ ràng.
- An toàn và phân quyền chính xác.
- Hạn chế lỗi dữ liệu.
- Dễ bảo trì và phát triển tiếp.
- Phù hợp với Laravel, Blade và Bootstrap 5.
- Có thể làm việc nhóm thông qua GitHub một cách an toàn.

## 16. Tham khảo mã nguồn giao diện Tabler và Volt Laravel

### 16.1. Nguồn tham khảo

Dự án sử dụng hai repository sau làm nguồn tham khảo cho thiết kế và triển khai giao diện:

**Tabler**
- Repository: https://github.com/tabler/tabler
- Mục đích: Tham khảo thiết kế dashboard, bố cục trang, sidebar, navbar, bảng dữ liệu, biểu mẫu, thẻ thống kê, badge trạng thái, phân trang, màu sắc, khoảng cách và responsive layout.

**Volt Laravel Dashboard**
- Repository: https://github.com/themesberg/volt-laravel-dashboard
- Mục đích: Tham khảo cách tổ chức giao diện quản trị trong Laravel, cấu trúc Blade layout, sidebar, navbar, footer, các trang quản trị, biểu mẫu và component dùng chung.

### 16.2. Quy tắc đọc và sử dụng mã nguồn tham khảo

Trước khi xây dựng hoặc cải tiến giao diện:

1. Kiểm tra xem các repository tham khảo có nằm trong workspace và có thể đọc được hay không.
2. Tìm những trang hoặc component phù hợp với chức năng đang triển khai.
3. Đọc mã nguồn HTML, CSS, JavaScript hoặc Blade liên quan trước khi đề xuất cách triển khai.
4. Dựa trên mã nguồn thực tế để xác định cấu trúc và cách sử dụng component. Không tự suy đoán tên class, đường dẫn tệp hoặc API của thư viện.
5. Chọn lọc các thành phần phù hợp, sau đó điều chỉnh theo nghiệp vụ và kiến trúc hiện có của Sports Complex Management System.
6. Nếu không thể truy cập mã nguồn tham khảo, hãy thông báo rõ và chỉ sử dụng những thông tin đã xác minh được. Không tuyên bố đã đọc repo khi chưa đọc.

### 16.3. Phân công vai trò cho từng nguồn

Ưu tiên Tabler để tham khảo:
- Phong cách thiết kế hiện đại.
- Hệ thống màu sắc và kiểu chữ.
- Dashboard và thẻ thống kê.
- Sidebar và navbar.
- Bảng dữ liệu, form, modal và badge.
- Bố cục responsive.
- Các trạng thái giao diện và component có thể tái sử dụng.

Ưu tiên Volt Laravel để tham khảo:
- Cách tổ chức layout Blade.
- Cấu trúc trang quản trị Laravel.
- Cách chia nhỏ layout, sidebar, navbar và footer.
- Cách tái sử dụng component giao diện.
- Cách tổ chức các trang quản lý dữ liệu.

Có thể kết hợp ý tưởng từ cả hai nguồn nhưng phải duy trì một hệ thống thiết kế thống nhất trong toàn bộ dự án.

### 16.4. Không sao chép nguyên trạng hoặc thay đổi kiến trúc

- Không sao chép toàn bộ một repository vào project chính chỉ để lấy giao diện.
- Không ghi đè mã nguồn Laravel hiện có bằng mã nguồn từ Volt.
- Không tự ý thay đổi cấu trúc cơ sở dữ liệu, route, controller, middleware hoặc quy tắc nghiệp vụ để phù hợp với template.
- Không tự ý đưa Livewire, Alpine.js hoặc các công nghệ khác vào dự án chỉ vì chúng xuất hiện trong Volt.
- Tiếp tục sử dụng Laravel, Blade, HTML, CSS, Bootstrap 5 và JavaScript thuần theo quy định của dự án.
- Chỉ tích hợp CSS, JavaScript, icon hoặc component cần thiết sau khi kiểm tra sự tương thích và ảnh hưởng đến các thành phần hiện có.
- Tránh nạp Bootstrap nhiều lần hoặc kết hợp các bộ CSS có thể gây xung đột.
- Kiểm tra giấy phép của thư viện, plugin, icon và tài nguyên trước khi tái sử dụng. Không mặc định mọi thành phần phụ thuộc trong repository đều có cùng giấy phép với repository chính.

### 16.5. Quy trình thực hiện một yêu cầu giao diện

Khi được yêu cầu xây dựng một trang mới:

1. Xác định chức năng và vai trò sử dụng.
2. Kiểm tra layout, component và CSS hiện có trong project chính.
3. Tìm một hoặc nhiều trang tham khảo phù hợp trong Tabler và Volt Laravel.
4. Phân tích cách bố trí, màu sắc, component và hành vi tương tác của các trang tham khảo.
5. Đề xuất bố cục phù hợp với nghiệp vụ của dự án.
6. Triển khai bằng Blade, HTML, CSS, Bootstrap 5 và JavaScript thuần.
7. Tái sử dụng layout và component chung thay vì tạo giao diện độc lập cho từng trang.
8. Kiểm tra responsive, trạng thái dữ liệu, thao tác của người dùng và sự nhất quán với các trang hiện có.

Mục tiêu là học hỏi và chọn lọc những điểm mạnh từ các nguồn tham khảo để xây dựng giao diện phù hợp với dự án, không phải sao chép nguyên mẫu hoặc biến dự án thành một bản cài đặt Tabler hay Volt.
**Hãy đọc mã nguồn trước khi sửa, hiểu nghiệp vụ trước khi code và kiểm tra kết quả trước khi báo cáo hoàn thành.**