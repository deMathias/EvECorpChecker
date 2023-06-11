docker rm evecorpchecker-debug
docker build -t evecorpchecker-debug . 
docker run -p 80:80 --name evecorpchecker-debug evecorpchecker-debug