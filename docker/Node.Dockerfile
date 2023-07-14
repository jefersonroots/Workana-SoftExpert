FROM node:14-alpine

COPY ../front-end/softExpert-front/package*.json ./


RUN npm install

WORKDIR /usr/src/app

COPY . .

EXPOSE 3000
CMD ["sh", "-c", "npm run dev"]