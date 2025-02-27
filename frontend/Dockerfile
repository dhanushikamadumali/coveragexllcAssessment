# Use Node.js as base image
FROM node:22-alpine

RUN npm install -g http-server

# Set working directory
WORKDIR /usr/app/

# Install dependencies
COPY package.json ./

RUN npm cache clean --force \
    && npm install --no-optional --force


# Copy the rest of the application
COPY . .

# Expose the port
EXPOSE 5173
CMD ["npm", "run", "dev"]
