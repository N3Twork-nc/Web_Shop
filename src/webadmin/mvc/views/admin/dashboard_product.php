<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Màu và Hình Ảnh</title>
</head>
<body>
    <form id="colorImageForm">
        <label for="colors">Chọn màu:</label>
        <div id="colorSelection">
            <label>
                <input type="checkbox" name="colors" value="red"> Đỏ
            </label>
            <label>
                <input type="checkbox" name="colors" value="blue"> Xanh
            </label>
            <!-- Thêm checkboxes cho các màu khác ở đây -->
        </div>

        <div id="sizeAndQuantity">
            <!-- Chổ để hiển thị size và nhập số lượng sẽ được thêm vào đây -->
        </div>

        <div id="imageUploads">
            <!-- Các nút "Chọn File" sẽ được thêm vào đây -->
        </div>

        <div id="imagePreviews">
            <!-- Hình ảnh được chọn sẽ được hiển thị ở đây -->
        </div>

        <button type="submit">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const colorSelection = document.getElementById('colorSelection');
            const sizeAndQuantity = document.getElementById('sizeAndQuantity');
            const imageUploads = document.getElementById('imageUploads');
            const imagePreviews = document.getElementById('imagePreviews');

            colorSelection.addEventListener('change', (event) => {
                const target = event.target;
                if (target.type === 'checkbox') {
                    const colorValue = target.value;
                    if (target.checked) {
                        // Nếu màu đã chọn, tạo nút "Chọn File" tương ứng.
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.accept = 'image/*';
                        fileInput.name = `image-${colorValue}[]`;
                        fileInput.required = true;
                        fileInput.multiple = true;
                        fileInput.addEventListener('change', (event) => {
                            // Xử lý khi người dùng chọn hình ảnh cho màu cụ thể ở đây.
                            const selectedImages = event.target.files;
                            if (selectedImages.length !== 4) {
                                alert('Bạn phải chọn đúng 4 hình ảnh.');
                                event.target.value = ''; // Xóa các hình ảnh đã chọn nếu không đủ 4.
                            } else {
                                console.log(`Chosen images for color ${colorValue}:`, selectedImages);
                            }
                        });
                        imageUploads.appendChild(fileInput);

                        // Hiển thị size và chỗ nhập số lượng
                        if (colorValue === 'red' || colorValue === 'blue') {
                            sizeAndQuantity.innerHTML = `
                                <label for="sizes">Nhập số lượng cho từng size size:</label><br/>
                                <label for=""> Size S
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size L
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size M
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size L
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size XL
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size XXL
                                    <input type="text">
                                </label><br/>
                            `;
                        } else {
                            sizeAndQuantity.innerHTML = ''; // Xóa nếu không phải là red hoặc blue.
                        }
                    } else {
                        // Nếu màu không được chọn, xóa nút "Chọn File" tương ứng (nếu có).
                        const existingFileInput = imageUploads.querySelector(`input[name="image-${colorValue}[]`);
                        if (existingFileInput) {
                            imageUploads.removeChild(existingFileInput);
                        }
                        // Xóa size và chỗ nhập số lượng
                        sizeAndQuantity.innerHTML = '';
                    }
                }
            });

            // Event listener for form submission.
            const form = document.getElementById('colorImageForm');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                // Thu thập dữ liệu từ form
                const formData = new FormData(form);

                // In ra toàn bộ dữ liệu trong formData
                for (const [name, value] of formData) {
                    console.log(`${name}: ${value}`);
                }
            });
        });
    </script>
</body>
</html>
