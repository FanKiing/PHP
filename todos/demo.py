class MyClass:
    def __init__(self,c):

        self.c=c
    def afficher(self):
        print(self.c)
        
obj=MyClass(200)
obj.afficher()