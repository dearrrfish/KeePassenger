FasdUAS 1.101.10   ��   ��    k             l     ��  ��    9 3 Scripts to copy in applications have own clipboard     � 	 	 f   S c r i p t s   t o   c o p y   i n   a p p l i c a t i o n s   h a v e   o w n   c l i p b o a r d   
  
 l     ��������  ��  ��        l     ��  ��      find : Text to be found     �   0   f i n d   :   T e x t   t o   b e   f o u n d      l     ��  ��    %  replace : Text to replace with     �   >   r e p l a c e   :   T e x t   t o   r e p l a c e   w i t h      l     ��  ��    %  someText : Text to be searched     �   >   s o m e T e x t   :   T e x t   t o   b e   s e a r c h e d      i         I      �� ���� 0 replacetext replaceText     !   o      ���� 0 find   !  " # " o      ���� 0 replace   #  $�� $ o      ���� 0 sometext someText��  ��    k     & % %  & ' & r      ( ) ( n      * + * 1    ��
�� 
txdl + 1     ��
�� 
ascr ) o      ���� 0 prevtids prevTIDs '  , - , r     . / . o    ���� 0 find   / n       0 1 0 1    
��
�� 
txdl 1 1    ��
�� 
ascr -  2 3 2 r     4 5 4 n     6 7 6 2   ��
�� 
citm 7 o    ���� 0 sometext someText 5 o      ���� 0 sometext someText 3  8 9 8 r     : ; : o    ���� 0 replace   ; n       < = < 1    ��
�� 
txdl = 1    ��
�� 
ascr 9  > ? > r     @ A @ b     B C B m     D D � E E   C o    ���� 0 sometext someText A o      ���� 0 sometext someText ?  F G F r    # H I H o    ���� 0 prevtids prevTIDs I n       J K J 1     "��
�� 
txdl K 1     ��
�� 
ascr G  L�� L L   $ & M M o   $ %���� 0 sometext someText��     N O N l     ��������  ��  ��   O  P Q P l     �� R S��   R &   check if application is running    S � T T @   c h e c k   i f   a p p l i c a t i o n   i s   r u n n i n g Q  U V U i     W X W I      �� Y���� 0 isactive isActive Y  Z�� Z o      ���� 0 appname appName��  ��   X O     [ \ [ E     ] ^ ] l   	 _���� _ n    	 ` a ` 1    	��
�� 
pnam a 2   ��
�� 
prcs��  ��   ^ o   	 
���� 0 appname appName \ m      b b�                                                                                  sevs  alis    �  Macintosh HD               �u�H+     /System Events.app                                               �m�W�|        ����  	                CoreServices    �u�      �X�       /   ,   +  =Macintosh HD:System: Library: CoreServices: System Events.app   $  S y s t e m   E v e n t s . a p p    M a c i n t o s h   H D  -System/Library/CoreServices/System Events.app   / ��   V  c d c l     ��������  ��  ��   d  e f e l     �� g h��   g   copy text to iTerm    h � i i &   c o p y   t e x t   t o   i T e r m f  j k j i     l m l I      �� n���� 0 copytoiterm copyToiTerm n  o�� o o      ���� 0 tocopy toCopy��  ��   m Z      p q���� p I     �� r���� 0 isactive isActive r  s�� s m     t t � u u 
 i T e r m��  ��   q I  	 �� v��
�� .sysodsct****        scpt v b   	  w x w b   	  y z y m   	 
 { { � | | d t e l l   a p p l i c a t i o n   " i T e r m "   t o   s e t   t h e   c l i p b o a r d   t o   " z o   
 ���� 0 tocopy toCopy x m     } } � ~ ~  "��  ��  ��   k   �  l     ��������  ��  ��   �  � � � i     � � � I     �� ���
�� .aevtoappnull  �   � **** � o      ���� 0 argv  ��   � k      � �  � � � I     �� ����� 0 copytoiterm copyToiTerm �  ��� � o    ���� 0 argv  ��  ��   �  ��� � l   �� � ���   �  	return argv    � � � �  	 r e t u r n   a r g v��   �  � � � l     ��������  ��  ��   �  ��� � l     ��������  ��  ��  ��       �� � � � � ���   � ���������� 0 replacetext replaceText�� 0 isactive isActive�� 0 copytoiterm copyToiTerm
�� .aevtoappnull  �   � **** � �� ���� � ����� 0 replacetext replaceText�� �� ���  �  �������� 0 find  �� 0 replace  �� 0 sometext someText��   � ���������� 0 find  �� 0 replace  �� 0 sometext someText�� 0 prevtids prevTIDs � ������ D
�� 
ascr
�� 
txdl
�� 
citm�� '��,E�O���,FO��-E�O���,FO�%E�O���,FO� � �� X���� � ����� 0 isactive isActive�� �� ���  �  ���� 0 appname appName��   � ���� 0 appname appName �  b����
�� 
prcs
�� 
pnam�� � 	*�-�,�U � �� m���� � ����� 0 copytoiterm copyToiTerm�� �� ���  �  ���� 0 tocopy toCopy��   � ���� 0 tocopy toCopy �  t�� { }���� 0 isactive isActive
�� .sysodsct****        scpt�� *�k+  �%�%j Y h � �� ����� � ���
�� .aevtoappnull  �   � ****�� 0 argv  ��   � ���� 0 argv   � ���� 0 copytoiterm copyToiTerm�� 	*�k+  OP ascr  ��ޭ