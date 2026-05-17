FROM node:22-alpine

WORKDIR /app

# Copy file cấu hình và cài đặt thư viện
COPY package*.json ./
RUN npm install

# Copy toàn bộ mã nguồn
COPY . .

# Mở port cho Vite
EXPOSE 5173

# Chạy Vite với host để Docker có thể ánh xạ port ra ngoài
CMD ["npm", "run", "dev", "--", "--host"]