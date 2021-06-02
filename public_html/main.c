#include <stdio.h>
#include <stdlib.h>

typedef struct node
{
    int data;
    struct node *next;
} Node;

Node* head = NULL;
int count=0;

Node* createNode(int data)
{
    Node* ptr = (Node*) malloc(sizeof(Node));
    ptr->data = data;
    ptr->next = NULL;
    return ptr;
}

void insertHead(int data)
{
    Node *n = createNode(data);
    n->next = head;
    head = n;
    ++count;
}

/*void insertTail(int data)
{
    Node *n = createNode(data);
    if(tail != NULL)
    {
        tail->
    }
}*/

void insertPos(int data, int pos)
{
    if(pos < 0)
        return;
    Node *n = createNode(data);
    Node* prev;
    Node* cur = head;
    for(int i=0; i<pos; ++i)
    {
        prev = cur;
        cur = cur->next;
    }
    if (prev != NULL)
        prev->next = n;
    n->next = cur;
    if(pos == 0)
        head = n;
    ++count;
}

void deleteHead()
{
   if(head != NULL)
   {
       Node *tmp = head;
       head = tmp->next;
       free(tmp);
       --count;
   }
}

void deleteTail()
{
    if(head != NULL)
    {
        Node *prev=NULL;
        Node* cur = head;
        while(cur->next != NULL)
        {
            prev = cur;
            cur = cur->next;
        }
        if(prev != NULL)
        {
            prev->next = NULL;
            head = NULL;
        }
        free(cur);
        --count;
    }
}

void deletePos(int pos)
{
    if(pos <0 || head == NULL)
        return;
    Node* prev=NULL;
    Node* cur = head;
    for(int i=0; i < pos; ++i)
    {
        prev = cur;
        cur = cur->next;
    }
    if(pos == 0)
        head = cur->next;
    if(prev != NULL)
        prev->next = cur->next;
    free(cur);
    --count;
}

void display()
{
    if(head != NULL)
    {
        Node* tmp = head;
        while(tmp != NULL)
        {
            printf("%d ", tmp->data);
            tmp = tmp->next;
        }
        printf("\n");
    }
}

int main()
{
    int data, ch, pos;
    while(1)
    {
        scanf("%d", &ch);
        switch(ch)
        {
            case 1:
                scanf("%d", &data);
                insertHead(data);
                break;
            /*case 2:
                printf("Enter the data : ");
                scanf("%d", &data);
                insertTail(data);
                break;*/
            case 3:
                scanf("%d", &data);
                scanf("%d", &pos);
                insertPos(data, pos);
                break;
            case 4:
                deleteHead();
                break;
            case 5:
                deleteTail();
                break;
            case 6:
                scanf("%d", &pos);
                deletePos(pos);
                break;
            case 7:
                display();
                break;
            default:
                exit(0);
        }
    }
    return 0;
}
  			